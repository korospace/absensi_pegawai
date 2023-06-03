/* 
	DROP table
	================================================ 
*/
DROP TABLE IF EXISTS db_ci3_absensi_pegawai.employee_task_documents;

DROP TABLE IF EXISTS db_ci3_absensi_pegawai.employee_tasks;

DROP TABLE IF EXISTS db_ci3_absensi_pegawai.manager_configs;

DROP TABLE IF EXISTS db_ci3_absensi_pegawai.employees;

DROP TABLE IF EXISTS db_ci3_absensi_pegawai.managers;

DROP TABLE IF EXISTS db_ci3_absensi_pegawai.users;

DROP TABLE IF EXISTS db_ci3_absensi_pegawai.user_levels;

/* 
	CREATE table
	================================================ 
*/

CREATE TABLE user_levels
(
    userLevelId INT(11)      AUTO_INCREMENT,
    name        VARCHAR(255) NOT NULL,

    PRIMARY KEY(userLevelId)
) ENGINE = InnoDB;

CREATE TABLE users
(
    userId	    INT(11)       AUTO_INCREMENT,
    userLevelId INT(11)       NOT NULL,
    username    VARCHAR(255)  NOT NULL,
    password    TEXT  		  NOT NULL,
    status      BOOLEAN       DEFAULT true,
    created_at  TIMESTAMP     DEFAULT CURRENT_TIMESTAMP,
    updated_at  TIMESTAMP     DEFAULT CURRENT_TIMESTAMP,

    PRIMARY KEY(userId),
	CONSTRAINT  fk_users_user_levels FOREIGN KEY (userLevelId) REFERENCES user_levels (userLevelId) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB;

CREATE TABLE managers
(
    managerId   INT(11)      AUTO_INCREMENT,
    userId      INT(11)       NOT NULL,
    name        VARCHAR(255)  NOT NULL,
    phone       VARCHAR(20)   DEFAULT NULL,
    img_profile VARCHAR(100)  DEFAULT NULL,
    NA          VARCHAR(1)    DEFAULT "N",
    created_at  TIMESTAMP     DEFAULT CURRENT_TIMESTAMP,
    updated_at  TIMESTAMP     DEFAULT CURRENT_TIMESTAMP,

    PRIMARY KEY(managerId),
	CONSTRAINT  fk_managers_users FOREIGN KEY (userId) REFERENCES users (userId) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB;

CREATE TABLE employees
(
    employeeId  INT(11)       AUTO_INCREMENT,
    userId      INT(11)       NOT NULL,
    managerId   INT(11)       NOT NULL,
    name        VARCHAR(255)  NOT NULL,
    phone       VARCHAR(20)   DEFAULT NULL,
    img_profile VARCHAR(100)  DEFAULT NULL,
    NA          VARCHAR(1)    DEFAULT "N",
    created_at  TIMESTAMP     DEFAULT CURRENT_TIMESTAMP,
    updated_at  TIMESTAMP     DEFAULT CURRENT_TIMESTAMP,

    PRIMARY KEY(employeeId),
	CONSTRAINT  fk_employees_users    FOREIGN KEY (userId)    REFERENCES users (userId)       ON DELETE CASCADE ON UPDATE CASCADE,
	CONSTRAINT  fk_employees_managers FOREIGN KEY (managerId) REFERENCES managers (managerId) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB;

CREATE TABLE manager_configs
(
    configId    	INT(11)      AUTO_INCREMENT,
    managerId   	INT(11)      NOT NULL,
    meet_link   	VARCHAR(250) DEFAULT NULL,
    meet_time_show  VARCHAR(8)   DEFAULT NULL,
    meet_time_hide  VARCHAR(8)   DEFAULT NULL,
    meet_days_show  VARCHAR(60)  DEFAULT NULL,
    created_at  TIMESTAMP    	 DEFAULT CURRENT_TIMESTAMP,
    updated_at  TIMESTAMP    	 DEFAULT CURRENT_TIMESTAMP,

    PRIMARY KEY(configId),
	CONSTRAINT  fk_manager_config_managers FOREIGN KEY (managerId) REFERENCES managers (managerId) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB;

CREATE TABLE employee_tasks
(
    taskId      INT(11)       AUTO_INCREMENT,
    employeeId  INT(11)       NOT NULL,
    managerId	INT(11)       DEFAULT NULL,
    title       VARCHAR(300)  NOT NULL,
    description TEXT		  DEFAULT NULL,
    instruction TEXT		  DEFAULT NULL,
	status		ENUM('onprogres','checking','accepted','revision') DEFAULT 'onprogres',
    created_at  TIMESTAMP     DEFAULT CURRENT_TIMESTAMP,
    updated_at  TIMESTAMP     DEFAULT CURRENT_TIMESTAMP,

    PRIMARY KEY(taskId),
	CONSTRAINT  fk_task_employees FOREIGN KEY (employeeId) REFERENCES employees (employeeId) ON DELETE CASCADE ON UPDATE CASCADE,
	CONSTRAINT  fk_task_managers  FOREIGN KEY (managerId)  REFERENCES managers (managerId)   ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE = InnoDB;

CREATE TABLE employee_task_documents
(
    docId       INT(11)       AUTO_INCREMENT,
    taskId      INT(11)       NOT NULL,
    file_name   VARCHAR(100)  NOT NULL,
    created_at  TIMESTAMP     DEFAULT CURRENT_TIMESTAMP,
    updated_at  TIMESTAMP     DEFAULT CURRENT_TIMESTAMP,

    PRIMARY KEY(docId),
	CONSTRAINT  fk_document_task FOREIGN KEY (taskId) REFERENCES employee_tasks (taskId) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB;

/* 
	INSERT table
	================================================ 
*/

INSERT INTO user_levels (name) VALUES ('manager');
INSERT INTO user_levels (name) VALUES ('employee');

INSERT INTO users (userLevelId,username,password) VALUES (
	1,
	'herlina123',
	'1bf2b78e9b2aa083bf42e1aa9a2b0404614ada2603628a317a741775d9e704b8f0728cee1a2538434539dc8b990e37f6db6517e6fa87ac59d7d2cd459f5f38693Vg+UjLRU3cfjNUgiquCva1Ql3cFsVX68EiXW+isPlw='
);
INSERT INTO users (userLevelId,username,password) VALUES (
	1,
	'heri123',
	'983f149377fa3bbdc0eb932526a534f8e2eaccb3b510545afdca3c1c6b67bd2e7a84ad626b807b862729053227f5bcfdf640ff5bcfa94fd8ea985b90b295cdcfSftfFYbX2lxPb9+kT3dPFSCnACCPdHrragMcK13y1J4='
);
INSERT INTO users (userLevelId,username,password) VALUES (
	2,
	'daniel123',
	'cc8f795593b5d9474fad67ad85e908396d0955b45abef691c3c2eec85a1ec98518baa9befc4f546043cdf53876567dbea1b5c1db97ab836b9e8259bb5919fd51mgLPtytanT2QSdEsgkWhneZTQmTggKsq5+PnztZLrh4='
);
INSERT INTO users (userLevelId,username,password) VALUES (
	2,
	'rilo123',
	'0bda6e6c54182f57379d448a5acbb77dc3fbedf57f80fc8fca84c5efa92fba36d245dc46d8c3fbabc233669951e8656f21a00231c394168925114d1cd4821e1fa1BV5OJ8ge7zZN8mpRnPoFKpj03N22q11OZ/IIaIn/k='
);

INSERT INTO managers (userId,name) VALUES (
	1,
	'herlina'
);
INSERT INTO managers (userId,name) VALUES (
	2,
	'heri'
);

INSERT INTO employees (userId,managerId,name) VALUES (
	3,
	1,
	'mustofa daniel'
);
INSERT INTO employees (userId,managerId,name) VALUES (
	4,
	2,
	'rilo anggoro'
);
