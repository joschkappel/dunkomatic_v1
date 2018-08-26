-- $CVSHeader: Dunkomatic/common/adodb/session/adodb-sessions.oracle.clob.sql,v 1.1 2008/11/05 15:11:21 jochen Exp $

DROP TABLE adodb_sessions;

CREATE TABLE sessions (
	sesskey		CHAR(32)	DEFAULT '' NOT NULL,
	expiry		INT		DEFAULT 0 NOT NULL,
	expireref	VARCHAR(64)	DEFAULT '',
	data		CLOB		DEFAULT '',
	PRIMARY KEY	(sesskey)
);

CREATE INDEX ix_expiry ON sessions (expiry);

QUIT;
