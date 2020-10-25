# phpMyAdmin MySQL-Dump
# version 2.2.6
# http://phpwizard.net/phpMyAdmin/
# http://www.phpmyadmin.net/ (download page)
#
# --------------------------------------------------------

#
# Table structure for table `snipcats`
#

CREATE TABLE snipcats (
    catID       TINYINT(4)   NOT NULL AUTO_INCREMENT,
    name        VARCHAR(50)  NOT NULL DEFAULT '',
    description VARCHAR(125) NOT NULL DEFAULT '',
    total       INT(11)      NOT NULL DEFAULT '0',
    weight      INT(11)      NOT NULL DEFAULT '1',
    groupid     VARCHAR(255) NOT NULL DEFAULT '1 2 3',
    PRIMARY KEY (catID),
    UNIQUE KEY catID (catID)
)
    ENGINE = ISAM COMMENT ='WF-Snippets by hsalazar, after Catzwolf';

# --------------------------------------------------------

#
# Table structure for table `snippets`
#

CREATE TABLE snippets (
    snippetID TINYINT(4)       NOT NULL AUTO_INCREMENT,
    catID     TINYINT(4)       NOT NULL DEFAULT '0',
    title     VARCHAR(75)      NOT NULL DEFAULT '0',
    body      TEXT             NOT NULL,
    summary   TEXT             NOT NULL,
    uid       INT(6)                    DEFAULT '1',
    submit    INT(1)           NOT NULL DEFAULT '0',
    datesub   INT(11)          NOT NULL DEFAULT '1033141070',
    counter   INT(8) UNSIGNED  NOT NULL DEFAULT '0',
    weight    INT(11)          NOT NULL DEFAULT '1',
    groupid   VARCHAR(255)     NOT NULL DEFAULT '1 2 3',
    rating    DOUBLE(6, 4)     NOT NULL DEFAULT '0.0000',
    votes     INT(11) UNSIGNED NOT NULL DEFAULT '0',
    PRIMARY KEY (snippetID),
    UNIQUE KEY snippetID (snippetID),
    FULLTEXT KEY body (body)
)
    ENGINE = ISAM COMMENT ='WF-Snippets by hsalazar, after Catzwolf';

# --------------------------------------------------------

#
# Table structure for table `snippets_votedata`
#

CREATE TABLE snippets_votedata (
    ratingid        INT(11) UNSIGNED    NOT NULL AUTO_INCREMENT,
    lid             INT(11) UNSIGNED    NOT NULL DEFAULT '0',
    ratinguser      INT(11)             NOT NULL DEFAULT '0',
    rating          TINYINT(3) UNSIGNED NOT NULL DEFAULT '0',
    ratinghostname  VARCHAR(60)         NOT NULL DEFAULT '',
    ratingtimestamp INT(10)             NOT NULL DEFAULT '0',
    PRIMARY KEY (ratingid),
    KEY ratinguser (ratinguser),
    KEY ratinghostname (ratinghostname),
    KEY lid (lid)
)
    ENGINE = ISAM;
