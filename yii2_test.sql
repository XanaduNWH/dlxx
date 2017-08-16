--
-- PostgreSQL database dump
--

-- Dumped from database version 9.6.3
-- Dumped by pg_dump version 9.6.3

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;
SET row_security = off;

--
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


--
-- Name: adminpack; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS adminpack WITH SCHEMA pg_catalog;


--
-- Name: EXTENSION adminpack; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION adminpack IS 'administrative functions for PostgreSQL';


--
-- Name: uuid-ossp; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS "uuid-ossp" WITH SCHEMA public;


--
-- Name: EXTENSION "uuid-ossp"; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION "uuid-ossp" IS 'generate universally unique identifiers (UUIDs)';


SET search_path = public, pg_catalog;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: auth_assignment; Type: TABLE; Schema: public; Owner: yii
--

CREATE TABLE auth_assignment (
    item_name character varying(64) NOT NULL,
    user_id integer NOT NULL,
    created_at timestamp with time zone DEFAULT now()
);


ALTER TABLE auth_assignment OWNER TO yii;

--
-- Name: auth_item; Type: TABLE; Schema: public; Owner: yii
--

CREATE TABLE auth_item (
    name character varying(64) NOT NULL,
    type integer NOT NULL,
    description text,
    rule_name character varying(64),
    data text,
    created_at timestamp with time zone DEFAULT now() NOT NULL,
    updated_at timestamp with time zone
);


ALTER TABLE auth_item OWNER TO yii;

--
-- Name: auth_item_child; Type: TABLE; Schema: public; Owner: yii
--

CREATE TABLE auth_item_child (
    parent character varying(64) NOT NULL,
    child character varying(64) NOT NULL
);


ALTER TABLE auth_item_child OWNER TO yii;

--
-- Name: auth_rule; Type: TABLE; Schema: public; Owner: yii
--

CREATE TABLE auth_rule (
    name character varying(64) NOT NULL,
    data text,
    created_at timestamp with time zone DEFAULT now() NOT NULL,
    updated_at timestamp with time zone
);


ALTER TABLE auth_rule OWNER TO yii;

--
-- Name: comments; Type: TABLE; Schema: public; Owner: yii
--

CREATE TABLE comments (
    id integer NOT NULL,
    thread_id integer NOT NULL,
    author_id integer DEFAULT '-1'::integer NOT NULL,
    author_email character varying NOT NULL,
    author_ip character varying(50),
    created_at timestamp with time zone DEFAULT now() NOT NULL,
    updated_at timestamp with time zone,
    approve_status integer,
    reply_to integer,
    content text NOT NULL
);


ALTER TABLE comments OWNER TO yii;

--
-- Name: COLUMN comments.author_email; Type: COMMENT; Schema: public; Owner: yii
--

COMMENT ON COLUMN comments.author_email IS '回复者邮箱';


--
-- Name: COLUMN comments.author_ip; Type: COMMENT; Schema: public; Owner: yii
--

COMMENT ON COLUMN comments.author_ip IS '回复者地址';


--
-- Name: COLUMN comments.created_at; Type: COMMENT; Schema: public; Owner: yii
--

COMMENT ON COLUMN comments.created_at IS '创建日期';


--
-- Name: COLUMN comments.updated_at; Type: COMMENT; Schema: public; Owner: yii
--

COMMENT ON COLUMN comments.updated_at IS '更新日期';


--
-- Name: COLUMN comments.approve_status; Type: COMMENT; Schema: public; Owner: yii
--

COMMENT ON COLUMN comments.approve_status IS '审核状态';


--
-- Name: COLUMN comments.content; Type: COMMENT; Schema: public; Owner: yii
--

COMMENT ON COLUMN comments.content IS '内容';


--
-- Name: comments_id_seq; Type: SEQUENCE; Schema: public; Owner: yii
--

CREATE SEQUENCE comments_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE comments_id_seq OWNER TO yii;

--
-- Name: comments_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: yii
--

ALTER SEQUENCE comments_id_seq OWNED BY comments.id;


--
-- Name: country; Type: TABLE; Schema: public; Owner: yii
--

CREATE TABLE country (
    code character varying(2) NOT NULL,
    name character varying(25) NOT NULL,
    population integer DEFAULT 0 NOT NULL
);


ALTER TABLE country OWNER TO yii;

--
-- Name: message; Type: TABLE; Schema: public; Owner: yii
--

CREATE TABLE message (
    id integer NOT NULL,
    language character varying(16) NOT NULL,
    translation text
);


ALTER TABLE message OWNER TO yii;

--
-- Name: migration; Type: TABLE; Schema: public; Owner: yii
--

CREATE TABLE migration (
    version character varying(180) NOT NULL,
    apply_time integer
);


ALTER TABLE migration OWNER TO yii;

--
-- Name: source_message; Type: TABLE; Schema: public; Owner: yii
--

CREATE TABLE source_message (
    id integer NOT NULL,
    category character varying(255),
    message text
);


ALTER TABLE source_message OWNER TO yii;

--
-- Name: source_message_id_seq; Type: SEQUENCE; Schema: public; Owner: yii
--

CREATE SEQUENCE source_message_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE source_message_id_seq OWNER TO yii;

--
-- Name: source_message_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: yii
--

ALTER SEQUENCE source_message_id_seq OWNED BY source_message.id;


--
-- Name: thread; Type: TABLE; Schema: public; Owner: yii
--

CREATE TABLE thread (
    id integer NOT NULL,
    author_id integer,
    created_at timestamp with time zone DEFAULT now() NOT NULL,
    updated_at timestamp with time zone,
    status smallint,
    title character varying(64) NOT NULL,
    content text NOT NULL,
    comment_count integer,
    updated_by integer DEFAULT '-1'::integer,
    lastcomment_at timestamp with time zone
);


ALTER TABLE thread OWNER TO yii;

--
-- Name: COLUMN thread.author_id; Type: COMMENT; Schema: public; Owner: yii
--

COMMENT ON COLUMN thread.author_id IS '创建人';


--
-- Name: COLUMN thread.created_at; Type: COMMENT; Schema: public; Owner: yii
--

COMMENT ON COLUMN thread.created_at IS '创建时间';


--
-- Name: COLUMN thread.updated_at; Type: COMMENT; Schema: public; Owner: yii
--

COMMENT ON COLUMN thread.updated_at IS '更新时间';


--
-- Name: COLUMN thread.status; Type: COMMENT; Schema: public; Owner: yii
--

COMMENT ON COLUMN thread.status IS '状态';


--
-- Name: COLUMN thread.title; Type: COMMENT; Schema: public; Owner: yii
--

COMMENT ON COLUMN thread.title IS '标题';


--
-- Name: COLUMN thread.content; Type: COMMENT; Schema: public; Owner: yii
--

COMMENT ON COLUMN thread.content IS '内容';


--
-- Name: COLUMN thread.comment_count; Type: COMMENT; Schema: public; Owner: yii
--

COMMENT ON COLUMN thread.comment_count IS '回复数';


--
-- Name: thread_id_seq; Type: SEQUENCE; Schema: public; Owner: yii
--

CREATE SEQUENCE thread_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE thread_id_seq OWNER TO yii;

--
-- Name: thread_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: yii
--

ALTER SEQUENCE thread_id_seq OWNED BY thread.id;


--
-- Name: user; Type: TABLE; Schema: public; Owner: yii
--

CREATE TABLE "user" (
    id integer NOT NULL,
    username character varying(255) NOT NULL,
    auth_key character varying(32) NOT NULL,
    password_hash character varying(255) NOT NULL,
    password_reset_token character varying(255),
    email character varying(255) NOT NULL,
    status smallint DEFAULT 10 NOT NULL,
    created_at timestamp with time zone DEFAULT now() NOT NULL,
    updated_at timestamp with time zone
);


ALTER TABLE "user" OWNER TO yii;

--
-- Name: user_id_seq; Type: SEQUENCE; Schema: public; Owner: yii
--

CREATE SEQUENCE user_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE user_id_seq OWNER TO yii;

--
-- Name: user_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: yii
--

ALTER SEQUENCE user_id_seq OWNED BY "user".id;


--
-- Name: comments id; Type: DEFAULT; Schema: public; Owner: yii
--

ALTER TABLE ONLY comments ALTER COLUMN id SET DEFAULT nextval('comments_id_seq'::regclass);


--
-- Name: source_message id; Type: DEFAULT; Schema: public; Owner: yii
--

ALTER TABLE ONLY source_message ALTER COLUMN id SET DEFAULT nextval('source_message_id_seq'::regclass);


--
-- Name: thread id; Type: DEFAULT; Schema: public; Owner: yii
--

ALTER TABLE ONLY thread ALTER COLUMN id SET DEFAULT nextval('thread_id_seq'::regclass);


--
-- Name: user id; Type: DEFAULT; Schema: public; Owner: yii
--

ALTER TABLE ONLY "user" ALTER COLUMN id SET DEFAULT nextval('user_id_seq'::regclass);


--
-- Data for Name: auth_assignment; Type: TABLE DATA; Schema: public; Owner: yii
--

COPY auth_assignment (item_name, user_id, created_at) FROM stdin;
author	2	2017-02-14 20:15:03.836536+08
admin	1	2017-02-14 20:15:03.839948+08
author	4	2017-02-14 20:15:23.195861+08
author	5	2017-02-14 20:17:23.043728+08
author	21	2017-02-16 15:08:13.675215+08
deletePost	1	2017-02-20 13:39:17.510091+08
moderator	2	2017-02-20 15:52:39.296352+08
\.


--
-- Data for Name: auth_item; Type: TABLE DATA; Schema: public; Owner: yii
--

COPY auth_item (name, type, description, rule_name, data, created_at, updated_at) FROM stdin;
createPost	2	Create a post	\N	\N	2017-02-14 20:15:03.73877+08	\N
updatePost	2	Update post	\N	\N	2017-02-14 20:15:03.791268+08	\N
author	1	\N	\N	\N	2017-02-14 20:15:03.805263+08	\N
admin	1	\N	\N	\N	2017-02-14 20:15:03.821128+08	\N
updateOwnPost	2	Update own post	isAuthor	\N	2017-02-14 20:15:03.854037+08	\N
deletePost	2	Delete post	\N	\N	2017-02-20 13:39:17.482718+08	\N
deleteOwnPost	2	Delete own post	\N	\N	2017-02-20 13:39:17.484737+08	\N
moderator	1	\N	\N	\N	2017-02-20 15:52:39.262589+08	\N
\.


--
-- Data for Name: auth_item_child; Type: TABLE DATA; Schema: public; Owner: yii
--

COPY auth_item_child (parent, child) FROM stdin;
author	createPost
admin	updatePost
admin	author
updateOwnPost	updatePost
author	updateOwnPost
admin	deletePost
deleteOwnPost	deletePost
moderator	author
moderator	deletePost
moderator	updatePost
\.


--
-- Data for Name: auth_rule; Type: TABLE DATA; Schema: public; Owner: yii
--

COPY auth_rule (name, data, created_at, updated_at) FROM stdin;
isAuthor	O:29:"common\\models\\rbac\\AuthorRule":3:{s:4:"name";s:8:"isAuthor";s:9:"createdAt";i:1487074503;s:9:"updatedAt";i:1487074503;}	2017-02-14 20:15:03.851706+08	\N
\.


--
-- Data for Name: comments; Type: TABLE DATA; Schema: public; Owner: yii
--

COPY comments (id, thread_id, author_id, author_email, author_ip, created_at, updated_at, approve_status, reply_to, content) FROM stdin;
30	4	4	my@xanadunwh.com	127.0.0.1	2017-02-24 10:42:33.785488+08	\N	10	\N	<p><strong>回复</strong><em>测试</em></p>\r\n\r\n<p>You have successfully created your Yii-powered application.</p>\r\n
31	4	4	my@xanadunwh.com	127.0.0.1	2017-02-24 11:03:20.027179+08	\N	10	\N	<p><span class="marker">Test</span> me</p>\r\n
32	4	4	testuser1@xanadunwh.com	127.0.0.1	2017-02-24 11:19:40.003696+08	\N	10	\N	<h1>Reply to this thread</h1>\r\n
33	2	2	回复测试	127.0.0.1	2017-02-27 12:20:36.380096+08	\N	10	\N	<p>回复</p>\r\n
34	9	2	my@xanadunwh.com	127.0.0.1	2017-02-27 12:21:07.093236+08	\N	10	\N	<p>再回复一个</p>\r\n
35	4	2	my@xanadunwh.com	127.0.0.1	2017-02-27 14:53:44.043384+08	\N	10	\N	<p>无内容</p>\r\n
36	9	2	my@xanadunwh.com	127.0.0.1	2017-02-27 15:23:29.524269+08	\N	10	\N	<p>回复</p>\r\n
37	9	2	testuser1@xanadunwh.com	127.0.0.1	2017-02-27 16:52:54.66626+08	\N	10	\N	<p>回复测试</p>\r\n
38	11	2	my@xanadunwh.com	127.0.0.1	2017-02-27 16:59:28.833432+08	\N	10	\N	<p>测试</p>\r\n
39	11	2	my@xanadunwh.com	127.0.0.1	2017-02-27 17:07:05.96339+08	\N	10	\N	<p>测试</p>\r\n
40	8	2	testuser@xanadunwh.com	127.0.0.1	2017-02-27 17:40:32.409906+08	\N	10	\N	<p>默认邮件测试</p>\r\n
41	4	2	my@xanadunwh.com	127.0.0.1	2017-02-27 18:19:49.040362+08	\N	10	\N	<p>回复测试</p>\r\n
42	11	2	my@xanadunwh.com	127.0.0.1	2017-02-27 18:23:25.630989+08	\N	10	\N	<p>回复</p>\r\n
43	11	2	my@xanadunwh.com	127.0.0.1	2017-02-27 18:26:05.580863+08	\N	10	\N	<p>About</p>\r\n
44	4	2	my@xanadunwh.com	127.0.0.1	2017-03-01 10:50:06.450813+08	\N	10	\N	<p>多回复几个</p>\r\n
45	4	2	my@xanadunwh.com	127.0.0.1	2017-03-01 10:50:29.926387+08	\N	10	\N	<p>测试</p>\r\n
46	4	2	my@xanadunwh.com	127.0.0.1	2017-03-01 11:46:13.972353+08	\N	10	\N	<p><span class="marker">Reply</span></p>\r\n
47	4	4	author1@xanadunwh.com	127.0.0.1	2017-03-02 10:43:30.834312+08	\N	10	\N	<p>提示信息测试</p>\r\n
48	4	4	author1@xanadunwh.com	127.0.0.1	2017-03-02 13:56:39.351501+08	\N	10	\N	<p>回复测试</p>\r\n
\.


--
-- Name: comments_id_seq; Type: SEQUENCE SET; Schema: public; Owner: yii
--

SELECT pg_catalog.setval('comments_id_seq', 49, true);


--
-- Data for Name: country; Type: TABLE DATA; Schema: public; Owner: yii
--

COPY country (code, name, population) FROM stdin;
AU	Australia	24016400
BR	Brazil	205722000
CA	Canada	35985751
DE	Germany	81459000
FR	France	64513242
GB	United Kingdom	65097000
IN	India	1285400000
RU	Russia	146519759
US	United States	322976000
CN	中国	1375210000
JP	日本	111
XX	Test Country	100000
X1	Test country2	100000
X2	API Updated Country	200000
AX	接口创建	123456
\.


--
-- Data for Name: message; Type: TABLE DATA; Schema: public; Owner: yii
--

COPY message (id, language, translation) FROM stdin;
3	zh_CN	\N
4	zh_CN	\N
5	zh_CN	\N
6	zh_CN	\N
7	zh_CN	\N
8	zh_CN	\N
9	zh_CN	\N
10	zh_CN	\N
11	zh_CN	\N
12	zh_CN	\N
13	zh_CN	\N
14	zh_CN	\N
15	zh_CN	\N
16	zh_CN	\N
17	zh_CN	\N
18	zh_CN	\N
19	zh_CN	\N
20	zh_CN	\N
21	zh_CN	\N
22	zh_CN	\N
23	zh_CN	\N
24	zh_CN	\N
25	zh_CN	\N
26	zh_CN	\N
27	zh_CN	\N
28	zh_CN	\N
29	zh_CN	\N
30	zh_CN	\N
31	zh_CN	\N
32	zh_CN	\N
33	zh_CN	\N
34	zh_CN	\N
35	zh_CN	\N
36	zh_CN	\N
37	zh_CN	\N
38	zh_CN	\N
39	zh_CN	\N
40	zh_CN	\N
41	zh_CN	\N
42	zh_CN	\N
43	zh_CN	\N
44	zh_CN	\N
45	zh_CN	\N
46	zh_CN	\N
47	zh_CN	\N
48	zh_CN	\N
49	zh_CN	\N
50	zh_CN	\N
51	zh_CN	\N
52	zh_CN	\N
53	zh_CN	\N
54	zh_CN	\N
55	zh_CN	\N
56	zh_CN	\N
57	zh_CN	\N
58	zh_CN	\N
59	zh_CN	\N
60	zh_CN	\N
61	zh_CN	\N
62	zh_CN	\N
63	zh_CN	\N
64	zh_CN	\N
65	zh_CN	\N
66	zh_CN	\N
67	zh_CN	\N
68	zh_CN	\N
69	zh_CN	\N
70	zh_CN	\N
71	zh_CN	\N
72	zh_CN	\N
73	zh_CN	\N
74	zh_CN	\N
75	zh_CN	\N
76	zh_CN	\N
77	zh_CN	\N
78	zh_CN	\N
79	zh_CN	\N
80	zh_CN	\N
81	zh_CN	\N
82	zh_CN	\N
83	zh_CN	\N
84	zh_CN	\N
85	zh_CN	\N
86	zh_CN	\N
87	zh_CN	\N
88	zh_CN	\N
89	zh_CN	\N
90	zh_CN	\N
91	zh_CN	\N
92	zh_CN	\N
93	zh_CN	\N
94	zh_CN	\N
95	zh_CN	\N
96	zh_CN	\N
97	zh_CN	\N
98	zh_CN	\N
99	zh_CN	\N
100	zh_CN	\N
101	zh_CN	\N
102	zh_CN	\N
103	zh_CN	\N
104	zh_CN	\N
105	zh_CN	\N
106	zh_CN	\N
107	zh_CN	\N
108	zh_CN	\N
109	zh_CN	\N
110	zh_CN	\N
111	zh_CN	\N
112	zh_CN	\N
\.


--
-- Data for Name: migration; Type: TABLE DATA; Schema: public; Owner: yii
--

COPY migration (version, apply_time) FROM stdin;
m000000_000000_base	1470884390
m130524_201442_init	1470884394
m140506_102106_rbac_init	1486626315
m170217_073424_addrule	1487559952
m170217_073424_delete_permission	1487569157
m170220_032303_moderator_role	1487577159
m150207_210500_i18n_init	1488527183
\.


--
-- Data for Name: source_message; Type: TABLE DATA; Schema: public; Owner: yii
--

COPY source_message (id, category, message) FROM stdin;
3	yii	{attribute} is invalid.
4	yii	The file "{file}" is not an image.
5	yii	The image "{file}" is too small. The width cannot be smaller than {limit, number} {limit, plural, one{pixel} other{pixels}}.
6	yii	The image "{file}" is too small. The height cannot be smaller than {limit, number} {limit, plural, one{pixel} other{pixels}}.
7	yii	The image "{file}" is too large. The width cannot be larger than {limit, number} {limit, plural, one{pixel} other{pixels}}.
8	yii	The image "{file}" is too large. The height cannot be larger than {limit, number} {limit, plural, one{pixel} other{pixels}}.
9	yii	{attribute} must be equal to "{compareValueOrAttribute}".
10	yii	{attribute} must not be equal to "{compareValueOrAttribute}".
11	yii	{attribute} must be greater than "{compareValueOrAttribute}".
12	yii	{attribute} must be greater than or equal to "{compareValueOrAttribute}".
13	yii	{attribute} must be less than "{compareValueOrAttribute}".
14	yii	{attribute} must be less than or equal to "{compareValueOrAttribute}".
15	yii	{attribute} is not a valid email address.
16	yii	{attribute} is not a valid URL.
17	yii	{attribute} must be a string.
18	yii	{attribute} should contain at least {min, number} {min, plural, one{character} other{characters}}.
19	yii	{attribute} should contain at most {max, number} {max, plural, one{character} other{characters}}.
20	yii	{attribute} should contain {length, number} {length, plural, one{character} other{characters}}.
21	yii	{attribute} must be a valid IP address.
22	yii	{attribute} must not be an IPv6 address.
23	yii	{attribute} must not be an IPv4 address.
24	yii	{attribute} contains wrong subnet mask.
25	yii	{attribute} must be an IP address with specified subnet.
26	yii	{attribute} must not be a subnet.
27	yii	{attribute} is not in the allowed range.
28	yii	{attribute} must be an integer.
29	yii	{attribute} must be a number.
30	yii	{attribute} must be no less than {min}.
31	yii	{attribute} must be no greater than {max}.
32	yii	{attribute} must be either "{true}" or "{false}".
33	yii	The combination {values} of {attributes} has already been taken.
34	yii	{attribute} "{value}" has already been taken.
35	yii	The format of {attribute} is invalid.
36	yii	File upload failed.
37	yii	Please upload a file.
38	yii	You can upload at most {limit, number} {limit, plural, one{file} other{files}}.
39	yii	Only files with these extensions are allowed: {extensions}.
40	yii	The file "{file}" is too big. Its size cannot exceed {formattedLimit}.
41	yii	The file "{file}" is too small. Its size cannot be smaller than {formattedLimit}.
42	yii	Only files with these MIME types are allowed: {mimeTypes}.
43	yii	the input value
44	yii	{attribute} cannot be blank.
45	yii	{attribute} must be "{requiredValue}".
46	yii	Unknown alias: -{name}
47	yii	Unknown option: --{name}
48	yii	Missing required arguments: {params}
49	yii	The verification code is incorrect.
50	yii	Home
51	yii	No results found.
52	yii	Showing <b>{begin, number}-{end, number}</b> of <b>{totalCount, number}</b> {totalCount, plural, one{item} other{items}}.
53	yii	Total <b>{count, number}</b> {count, plural, one{item} other{items}}.
54	yii	An internal server error occurred.
55	yii	Login Required
56	yii	Page not found.
57	yii	Invalid data received for parameter "{param}".
58	yii	Missing required parameters: {params}
59	yii	Unable to verify your data submission.
60	yii	Error
61	yii	The requested view "{name}" was not found.
62	yii	You are not allowed to perform this action.
63	yii	 and 
64	yii	Please fix the following errors:
65	yii	Are you sure you want to delete this item?
66	yii	View
67	yii	Update
68	yii	Delete
69	yii	No
70	yii	Yes
71	yii	(not set)
72	yii	in {delta, plural, =1{a year} other{# years}}
73	yii	in {delta, plural, =1{a month} other{# months}}
74	yii	in {delta, plural, =1{a day} other{# days}}
75	yii	in {delta, plural, =1{an hour} other{# hours}}
76	yii	in {delta, plural, =1{a minute} other{# minutes}}
77	yii	just now
78	yii	in {delta, plural, =1{a second} other{# seconds}}
79	yii	{delta, plural, =1{a year} other{# years}} ago
80	yii	{delta, plural, =1{a month} other{# months}} ago
81	yii	{delta, plural, =1{a day} other{# days}} ago
82	yii	{delta, plural, =1{an hour} other{# hours}} ago
83	yii	{delta, plural, =1{a minute} other{# minutes}} ago
84	yii	{delta, plural, =1{a second} other{# seconds}} ago
85	yii	{delta, plural, =1{1 year} other{# years}}
86	yii	{delta, plural, =1{1 month} other{# months}}
87	yii	{delta, plural, =1{1 day} other{# days}}
88	yii	{delta, plural, =1{1 hour} other{# hours}}
89	yii	{delta, plural, =1{1 minute} other{# minutes}}
90	yii	{delta, plural, =1{1 second} other{# seconds}}
91	yii	{nFormatted} B
92	yii	{nFormatted} KiB
93	yii	{nFormatted} MiB
94	yii	{nFormatted} GiB
95	yii	{nFormatted} TiB
96	yii	{nFormatted} PiB
97	yii	{nFormatted} KB
98	yii	{nFormatted} MB
99	yii	{nFormatted} GB
100	yii	{nFormatted} TB
101	yii	{nFormatted} PB
102	yii	{nFormatted} {n, plural, =1{byte} other{bytes}}
103	yii	{nFormatted} {n, plural, =1{kibibyte} other{kibibytes}}
104	yii	{nFormatted} {n, plural, =1{mebibyte} other{mebibytes}}
105	yii	{nFormatted} {n, plural, =1{gibibyte} other{gibibytes}}
106	yii	{nFormatted} {n, plural, =1{tebibyte} other{tebibytes}}
107	yii	{nFormatted} {n, plural, =1{pebibyte} other{pebibytes}}
108	yii	{nFormatted} {n, plural, =1{kilobyte} other{kilobytes}}
109	yii	{nFormatted} {n, plural, =1{megabyte} other{megabytes}}
110	yii	{nFormatted} {n, plural, =1{gigabyte} other{gigabytes}}
111	yii	{nFormatted} {n, plural, =1{terabyte} other{terabytes}}
112	yii	{nFormatted} {n, plural, =1{petabyte} other{petabytes}}
\.


--
-- Name: source_message_id_seq; Type: SEQUENCE SET; Schema: public; Owner: yii
--

SELECT pg_catalog.setval('source_message_id_seq', 112, true);


--
-- Data for Name: thread; Type: TABLE DATA; Schema: public; Owner: yii
--

COPY thread (id, author_id, created_at, updated_at, status, title, content, comment_count, updated_by, lastcomment_at) FROM stdin;
3	5	2017-02-14 20:19:08.832269+08	\N	10	Created By author2	No text	\N	\N	\N
5	4	2017-02-24 14:41:24.792007+08	\N	10	Heading	<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>\r\n	\N	\N	\N
7	2	2017-02-27 10:27:15.558283+08	\N	10	测试一下	<p>测试文本</p>\r\n	\N	-1	\N
2	4	2017-02-14 15:22:58.320639+08	2017-02-27 12:20:36.393332+08	10	test1	abcdef	1	2	2017-02-27 12:20:36.393332+08
9	2	2017-02-27 10:51:46.393706+08	2017-02-27 16:52:54.67423+08	10	默认值测试	<p>beforesave</p>\r\n\r\n<p>再更新一下</p>\r\n	3	2	2017-02-27 16:52:54.67423+08
10	2	2017-02-27 11:01:57.875334+08	2017-02-27 17:26:42.926935+08	10	新建测试	<p>无内容</p>\r\n\r\n<p><strong>更新一下</strong></p>\r\n	\N	2	2017-02-27 17:26:42.926935+08
8	2	2017-02-27 10:29:33.754512+08	\N	10	测试	<p>一下</p>\r\n	1	2	2017-02-27 17:40:32.414722+08
11	2	2017-02-27 11:03:07.976804+08	2017-02-27 18:25:08.068643+08	10	再新建一个	<p>测试更新1</p>\r\n	3	2	2017-02-27 18:26:05.588476+08
4	4	2017-02-21 10:18:38.979238+08	\N	10	CKEdtor test	<p><strong>Bold</strong> font</p>\r\n\r\n<p><strong><em>中文</em></strong>测试</p>\r\n\r\n<p><a href="https://blog.xanadunwh.com" target="_blank">中暑山庄</a></p>\r\n	10	4	2017-03-02 13:56:39.371116+08
12	4	2017-03-02 15:41:16.075433+08	\N	10	自定义验证器	<p>测试</p>\r\n	\N	\N	\N
15	2	2017-03-07 15:47:01.307942+08	\N	10	testdate	<p>testload</p>\r\n	\N	\N	\N
\.


--
-- Name: thread_id_seq; Type: SEQUENCE SET; Schema: public; Owner: yii
--

SELECT pg_catalog.setval('thread_id_seq', 15, true);


--
-- Data for Name: user; Type: TABLE DATA; Schema: public; Owner: yii
--

COPY "user" (id, username, auth_key, password_hash, password_reset_token, email, status, created_at, updated_at) FROM stdin;
9	author5	LrnhWGDMNOObWn4LHM0ijDIm-T6H7jp2	$2y$13$/94JmLy6om4I.1.NOWcNAOd10hhGbAiDhFmmRuVcpj0RMpY.smR7a	\N	author5@xanadunwh.com	10	2017-02-13 19:32:16.94175+08	2017-02-13 19:32:16.94175+08
10	author6	O_2rxUvTVaJwR5eRhwqRzxfLmssB8Jg4	$2y$13$2lz4CYfOGqyyaZyRx2vZ9eNp0PnIDK3lcOqD8SCpmbBkthAYD009i	\N	author6@xanadunwh.com	10	2017-02-13 21:05:41.375875+08	2017-02-13 21:05:41.375875+08
11	author7	aUDms4IX8w6AWjhh3M9I_50Pn7FP3bJ8	$2y$13$XkSSnKf6NYHiH1mkXHVHLe/Kkn6P3f6oGleZXBjABsBN0LOHEDlSm	\N	author7@xanadunwh.com	10	2017-02-13 21:06:47.111871+08	2017-02-13 21:06:47.111871+08
12	author8	aHG7pvRznbKkZt0ZqmjI6_ij4YFYGVv0	$2y$13$op8nXhpNP1iB5uvpgsp9CueEmsrPq3tl679qM4Dx4fmQfW9q1Q3z2	\N	author8@xanadunwh.com	10	2017-02-13 21:20:58.201435+08	2017-02-13 21:20:58.201435+08
13	author9	BP2PCzYwFzkZGZfhHaP81wsAB-DigQuX	$2y$13$sl1TC1ILPISIcg0UJXPO8uAo3XDIldxX8FRzpiU85U69OOw19.WXm	\N	author9@xanadunwh.com	10	2017-02-13 21:47:59.329439+08	2017-02-13 21:47:59.329439+08
14	author10	FkpaXWAUYL1DwSLHEG-_nDL5T_QzaSRj	$2y$13$VGP4/eChxueVRrLpfPDwJOFtEMslQ3LJYMMS3zRfUnZsuTPltMr3u	\N	author10@xanadunwh.com	10	2017-02-14 10:19:24.081345+08	2017-02-14 10:19:24.081345+08
3	testuser2	pnF63pngYaRh_1gp8C22cTPiTf7H4Qv6	$2y$13$yLr0pCYOjDd751od2ZT1ZeNcLxtOht5m/pfb1cDQJ0j9Zj4Acz3.6	\N	testuser2@xanadunwh.com	10	2017-02-15 15:36:29.774606+08	\N
4	author1	8mqkSye4rKFDA-Qmc8Nuevak5OczDpI5	$2y$13$oHtBuqxRcgKPgF4bkInRBeVitEPaTYb8LIQ3vtl/wHL2GZTsJQ.u.	\N	author1@xanadunwh.com	10	2017-02-15 15:36:29.774606+08	\N
5	author2	IJMRf-y8Ne4NXRoS-C_8uFg0W00tLPQc	$2y$13$3aT1rsVvOgtowvSYNFbVru8SikRYidfMM8.l9BCDIKOypjykU39ym	\N	author2@xanadunwh.com	10	2017-02-15 15:36:29.774606+08	\N
6	author3	y0fLXZgzXO_D09th_9ZypKGzhGt_CuTu	$2y$13$C8m/ZC//c4797fEh7KBI5OrI8grYZeRAVXY4IeQuYhOq3dxtjxuSC	\N	author3@xanadunwh.com	10	2017-02-15 15:36:29.774606+08	\N
7	author4	GbJoLcOcvM7vQ8Gb0jUICjzERYaJrjBm	$2y$13$2BuRW5qtUOCwXZOYk0l7tuVi3qqk8ex/ZmCw65hAkSPGJUUu3MtAS	\N	author4@xanadunwh.com	10	2017-02-15 15:36:29.774606+08	\N
21	author11	Bc_TDBFF2EIaNBF8qTMQ9bM0ZB7u2APk	$2y$13$lWQThbK/FvLdatXAJMco9ON.nnJIaIt71yx5.W9XYilMIvj00FEsq	\N	author11@xanadunwh.com	10	2017-02-16 15:08:13.636209+08	2017-02-16 15:08:13.636209+08
-1	deleted	aMsnbYlRJzrJ1amqjf8i_GZk7f22wGpP	$2y$13$GxNKCNs8iIKRa3lwLKTVZubqkbVxo0)93ncEAyL.cRUVYWYI8QoNe	\N	deleted	10	2017-02-27 10:24:19.629802+08	\N
1	admin	aMsnbYlRJzrJ1amqZZVyBGZk7f22wGpP	$2y$13$GxNKCNs8iIKRa3lwLKTVZubqkbVxM6OV5ncEAyL.cRUVYWYI8QoNe	\N	admin@xanadunwh.com	10	2017-02-15 15:36:29.774606+08	\N
2	hades	_5bsMukGscfsozQxC0x6X99kGtIBvvS5	$2y$13$7VqrzUhaoZl6TWLNv8nVV.kRRshYh/D8JBPQn1O8q5P5Fvpoq1ST.	\N	my@xanadunwh.com	10	2017-02-15 15:36:29.774606+08	\N
\.


--
-- Name: user_id_seq; Type: SEQUENCE SET; Schema: public; Owner: yii
--

SELECT pg_catalog.setval('user_id_seq', 23, true);


--
-- Name: auth_assignment auth_assignment_pkey; Type: CONSTRAINT; Schema: public; Owner: yii
--

ALTER TABLE ONLY auth_assignment
    ADD CONSTRAINT auth_assignment_pkey PRIMARY KEY (item_name, user_id);


--
-- Name: auth_item_child auth_item_child_pkey; Type: CONSTRAINT; Schema: public; Owner: yii
--

ALTER TABLE ONLY auth_item_child
    ADD CONSTRAINT auth_item_child_pkey PRIMARY KEY (parent, child);


--
-- Name: auth_item auth_item_pkey; Type: CONSTRAINT; Schema: public; Owner: yii
--

ALTER TABLE ONLY auth_item
    ADD CONSTRAINT auth_item_pkey PRIMARY KEY (name);


--
-- Name: auth_rule auth_rule_pkey; Type: CONSTRAINT; Schema: public; Owner: yii
--

ALTER TABLE ONLY auth_rule
    ADD CONSTRAINT auth_rule_pkey PRIMARY KEY (name);


--
-- Name: country code; Type: CONSTRAINT; Schema: public; Owner: yii
--

ALTER TABLE ONLY country
    ADD CONSTRAINT code PRIMARY KEY (code);


--
-- Name: comments comments_id_pkey; Type: CONSTRAINT; Schema: public; Owner: yii
--

ALTER TABLE ONLY comments
    ADD CONSTRAINT comments_id_pkey PRIMARY KEY (id);


--
-- Name: migration migration_pkey; Type: CONSTRAINT; Schema: public; Owner: yii
--

ALTER TABLE ONLY migration
    ADD CONSTRAINT migration_pkey PRIMARY KEY (version);


--
-- Name: message pk_message_id_language; Type: CONSTRAINT; Schema: public; Owner: yii
--

ALTER TABLE ONLY message
    ADD CONSTRAINT pk_message_id_language PRIMARY KEY (id, language);


--
-- Name: source_message source_message_pkey; Type: CONSTRAINT; Schema: public; Owner: yii
--

ALTER TABLE ONLY source_message
    ADD CONSTRAINT source_message_pkey PRIMARY KEY (id);


--
-- Name: thread thread_pkey; Type: CONSTRAINT; Schema: public; Owner: yii
--

ALTER TABLE ONLY thread
    ADD CONSTRAINT thread_pkey PRIMARY KEY (id);


--
-- Name: user user_email_key; Type: CONSTRAINT; Schema: public; Owner: yii
--

ALTER TABLE ONLY "user"
    ADD CONSTRAINT user_email_key UNIQUE (email);


--
-- Name: user user_password_reset_token_key; Type: CONSTRAINT; Schema: public; Owner: yii
--

ALTER TABLE ONLY "user"
    ADD CONSTRAINT user_password_reset_token_key UNIQUE (password_reset_token);


--
-- Name: user user_pkey; Type: CONSTRAINT; Schema: public; Owner: yii
--

ALTER TABLE ONLY "user"
    ADD CONSTRAINT user_pkey PRIMARY KEY (id);


--
-- Name: user user_username_key; Type: CONSTRAINT; Schema: public; Owner: yii
--

ALTER TABLE ONLY "user"
    ADD CONSTRAINT user_username_key UNIQUE (username);


--
-- Name: fki_thread_fkey; Type: INDEX; Schema: public; Owner: yii
--

CREATE INDEX fki_thread_fkey ON thread USING btree (author_id);


--
-- Name: fki_thread_updated_by_fkey; Type: INDEX; Schema: public; Owner: yii
--

CREATE INDEX fki_thread_updated_by_fkey ON thread USING btree (updated_by);


--
-- Name: idx-auth_item-type; Type: INDEX; Schema: public; Owner: yii
--

CREATE INDEX "idx-auth_item-type" ON auth_item USING btree (type);


--
-- Name: idx_message_language; Type: INDEX; Schema: public; Owner: yii
--

CREATE INDEX idx_message_language ON message USING btree (language);


--
-- Name: idx_source_message_category; Type: INDEX; Schema: public; Owner: yii
--

CREATE INDEX idx_source_message_category ON source_message USING btree (category);


--
-- Name: auth_assignment auth_assignment_item_name_fkey; Type: FK CONSTRAINT; Schema: public; Owner: yii
--

ALTER TABLE ONLY auth_assignment
    ADD CONSTRAINT auth_assignment_item_name_fkey FOREIGN KEY (item_name) REFERENCES auth_item(name) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: auth_assignment auth_assignment_user_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: yii
--

ALTER TABLE ONLY auth_assignment
    ADD CONSTRAINT auth_assignment_user_id_fkey FOREIGN KEY (user_id) REFERENCES "user"(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: auth_item_child auth_item_child_child_fkey; Type: FK CONSTRAINT; Schema: public; Owner: yii
--

ALTER TABLE ONLY auth_item_child
    ADD CONSTRAINT auth_item_child_child_fkey FOREIGN KEY (child) REFERENCES auth_item(name) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: auth_item_child auth_item_child_parent_fkey; Type: FK CONSTRAINT; Schema: public; Owner: yii
--

ALTER TABLE ONLY auth_item_child
    ADD CONSTRAINT auth_item_child_parent_fkey FOREIGN KEY (parent) REFERENCES auth_item(name) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: auth_item auth_item_rule_name_fkey; Type: FK CONSTRAINT; Schema: public; Owner: yii
--

ALTER TABLE ONLY auth_item
    ADD CONSTRAINT auth_item_rule_name_fkey FOREIGN KEY (rule_name) REFERENCES auth_rule(name) ON UPDATE CASCADE ON DELETE SET NULL;


--
-- Name: comments comments_author_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: yii
--

ALTER TABLE ONLY comments
    ADD CONSTRAINT comments_author_id_fkey FOREIGN KEY (author_id) REFERENCES "user"(id) ON UPDATE CASCADE ON DELETE SET DEFAULT;


--
-- Name: comments comments_thread_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: yii
--

ALTER TABLE ONLY comments
    ADD CONSTRAINT comments_thread_id_fkey FOREIGN KEY (thread_id) REFERENCES thread(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: message fk_message_source_message; Type: FK CONSTRAINT; Schema: public; Owner: yii
--

ALTER TABLE ONLY message
    ADD CONSTRAINT fk_message_source_message FOREIGN KEY (id) REFERENCES source_message(id) ON UPDATE RESTRICT ON DELETE CASCADE;


--
-- Name: thread thread_author_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: yii
--

ALTER TABLE ONLY thread
    ADD CONSTRAINT thread_author_id_fkey FOREIGN KEY (author_id) REFERENCES "user"(id) ON UPDATE CASCADE ON DELETE SET DEFAULT;


--
-- Name: thread thread_updated_by_fkey; Type: FK CONSTRAINT; Schema: public; Owner: yii
--

ALTER TABLE ONLY thread
    ADD CONSTRAINT thread_updated_by_fkey FOREIGN KEY (updated_by) REFERENCES "user"(id) ON UPDATE CASCADE ON DELETE SET DEFAULT;


--
-- PostgreSQL database dump complete
--

