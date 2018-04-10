<?php

namespace oauth\modules;

use Yii;
use oauth\modules\user\models\Oauth2AuthorizationCode;

class myAuthorizeFilter extends conquer\oauth2\AuthorizeFilter
{
	public function getScopes() {
		$responseType = $this->getResponseType();
		//New model/table Oauth2UserScopes
		$userscopes = Oauth2UserScopes::findOne([
			'user_id' => Yii::$app->user->getId(),
			'client_id' => $responseType->client_id
			]);
		if (!$userscopes) {
			$userscopes = new Oauth2UserScopes([
				'user_id' => Yii::$app->user->getId(),
				'client_id' => $responseType->client_id]
				);
			$userscopes->save();
		}

		return [$userscopes, $responseType];
	}
	public function afterAction($action, $result) {
		if (!Yii::$app->user->isGuest) {
			list($userscopes, $responseType) = $this->getScopes();

			$approvedScopes = explode(' ', trim($userscopes->approved_scopes));
			$rejectedScopes = explode(' ', trim($userscopes->rejected_scopes));

			$requestedScopes = explode(' ', trim($responseType->scope));

			$missingscopes = array_diff($requestedScopes, $approvedScopes, $rejectedScopes);

			if (count($missingscopes) == 0) {
				$responseType->scope = trim(implode(' ', array_intersect($approvedScopes, $requestedScopes)));
				$this->finishAuthorization();
			}
		}
		return $result;
	}
	public function haveAuthorization() {
		$requestedParams = Yii::$app->request->queryParams;
		$user_authorization_code = new Oauth2AuthorizationCode;

		return $user_authorization_code->findOne([
			'client_id' => $requestedParams['client_id'],
			'user_id' => Yii::$app->user->id,
			['<>', 'scope', NULL]
		]) ? TRUE : FALSE;
	}
}

