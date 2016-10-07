CREATE TABLE member (
  member_id varchar(255) NOT NULL default '',
  member_password varchar(32) default NULL,
  PRIMARY KEY  (member_id)
);

CREATE TABLE preferences (
  user_id varchar(255) NOT NULL default '',
  pref_id varchar(32) NOT NULL default '',
  pref_value longtext NOT NULL,
  PRIMARY KEY  (user_id,pref_id)
);

CREATE TABLE forum (
  forum_id integer(11) NOT NULL auto_increment,
  forum_topic integer(11) default NULL,
  forum_owner varchar(255) default NULL,
  forum_member tinyint(1) default NULL,
  forum_title varchar(100) default NULL,
  forum_date timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  forum_format varchar(10) default NULL,
  forum_message text,
  PRIMARY KEY  (forum_id)
);
