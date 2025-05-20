DROP SCHEMA dbo;

CREATE SCHEMA dbo;

CREATE TABLE dbo.accountStatus (
	accountStatusId int NOT NULL,
	statusName nvarchar(100) COLLATE SQL_Latin1_General_CP1_CI_AS NULL,
	CONSTRAINT PK__accountS__72A236B957792501 PRIMARY KEY (accountStatusId)
);

CREATE TABLE dbo.awards (
	awardId int IDENTITY(1,1) NOT NULL,
	awardType nvarchar(100) COLLATE SQL_Latin1_General_CP1_CI_AS NULL,
	awardName nvarchar(100) COLLATE SQL_Latin1_General_CP1_CI_AS NULL,
	awardFrom nvarchar(100) COLLATE SQL_Latin1_General_CP1_CI_AS NULL,
	awardDate date NULL,
	CONSTRAINT PK__awards__994F74722192C424 PRIMARY KEY (awardId)
);

CREATE TABLE dbo.bac (
	bacId int IDENTITY(1,1) NOT NULL,
	bacPdf nvarchar(255) COLLATE SQL_Latin1_General_CP1_CI_AS NULL,
	bacTitle nvarchar(255) COLLATE SQL_Latin1_General_CP1_CI_AS NULL,
	bacUploadDate datetime DEFAULT getdate() NULL,
	bacDesc text COLLATE SQL_Latin1_General_CP1_CI_AS NULL,
	CONSTRAINT PK__bac__96ABC4ACD0E9992A PRIMARY KEY (bacId)
);

CREATE TABLE dbo.complaintNatures (
	natureId int NOT NULL,
	complaintReason text COLLATE SQL_Latin1_General_CP1_CI_AS NULL,
	CONSTRAINT PK__complain__A76920086674DAB4 PRIMARY KEY (natureId)
);

CREATE TABLE dbo.complaintStatus (
	statusId int NOT NULL,
	statusName nvarchar(100) COLLATE SQL_Latin1_General_CP1_CI_AS NULL,
	CONSTRAINT PK__complain__36257A182A0305AC PRIMARY KEY (statusId)
);

CREATE TABLE dbo.consumerPromptPayers (
	payerId int IDENTITY(1,1) NOT NULL,
	payerName nvarchar(255) COLLATE SQL_Latin1_General_CP1_CI_AS NULL,
	payerAddress nvarchar(255) COLLATE SQL_Latin1_General_CP1_CI_AS NULL,
	CONSTRAINT PK__consumer__2DBFD2851D6C1E7E PRIMARY KEY (payerId)
);

CREATE TABLE dbo.districtOffices (
	districtId int IDENTITY(1,1) NOT NULL,
	districtName nvarchar(100) COLLATE SQL_Latin1_General_CP1_CI_AS NULL,
	hotline nvarchar(100) COLLATE SQL_Latin1_General_CP1_CI_AS NULL,
	contactNum nvarchar(100) COLLATE SQL_Latin1_General_CP1_CI_AS NULL,
	DCSO nvarchar(100) COLLATE SQL_Latin1_General_CP1_CI_AS NULL,
	teller nvarchar(100) COLLATE SQL_Latin1_General_CP1_CI_AS NULL,
	stationLineman nvarchar(100) COLLATE SQL_Latin1_General_CP1_CI_AS NULL,
	districtPic nvarchar(100) COLLATE SQL_Latin1_General_CP1_CI_AS NULL,
	CONSTRAINT PK__district__2BAEF71012C9663D PRIMARY KEY (districtId)
);

CREATE TABLE dbo.downloads (
	downloadId int IDENTITY(1,1) NOT NULL,
	pdfName nvarchar(255) COLLATE SQL_Latin1_General_CP1_CI_AS NULL,
	downloadsTitle nvarchar(255) COLLATE SQL_Latin1_General_CP1_CI_AS NULL,
	uploadDate datetime DEFAULT getdate() NULL,
	CONSTRAINT PK__download__A904E13825A5898E PRIMARY KEY (downloadId)
);

CREATE TABLE dbo.news (
	newsId int IDENTITY(1,1) NOT NULL,
	newsPic nvarchar(255) COLLATE SQL_Latin1_General_CP1_CI_AS NULL,
	newsTitle nvarchar(100) COLLATE SQL_Latin1_General_CP1_CI_AS NULL,
	newsDesc text COLLATE SQL_Latin1_General_CP1_CI_AS NULL,
	employeeId int NULL,
	uploadDate datetime DEFAULT getdate() NULL,
	CONSTRAINT PK__news__5218041E8AFC102A PRIMARY KEY (newsId)
);

CREATE TABLE dbo.passwordResets (
	id int IDENTITY(1,1) NOT NULL,
	accountId int NOT NULL,
	token varchar(64) COLLATE SQL_Latin1_General_CP1_CI_AS NOT NULL,
	createdAt datetime DEFAULT getdate() NOT NULL,
	expiresAt datetime NOT NULL,
	CONSTRAINT PK__password__3213E83F2D011BCC PRIMARY KEY (id)
);

CREATE TABLE dbo.positions (
	positionId int IDENTITY(1,1) NOT NULL,
	positionName varchar(100) COLLATE SQL_Latin1_General_CP1_CI_AS NULL,
	CONSTRAINT PK__position__B07CF5AE81E5B56D PRIMARY KEY (positionId)
);

CREATE TABLE dbo.rates (
	rateId int IDENTITY(1,1) NOT NULL,
	pdf nvarchar(255) COLLATE SQL_Latin1_General_CP1_CI_AS NULL,
	[date] date NULL,
	rateType nvarchar(255) COLLATE SQL_Latin1_General_CP1_CI_AS NULL,
	CONSTRAINT PK__rates__5705EA1477963668 PRIMARY KEY (rateId)
);

CREATE TABLE dbo.services (
	serviceId int IDENTITY(1,1) NOT NULL,
	servicePic nvarchar(100) COLLATE SQL_Latin1_General_CP1_CI_AS NULL,
	serviceTitle nvarchar(100) COLLATE SQL_Latin1_General_CP1_CI_AS NULL,
	serviceDesc text COLLATE SQL_Latin1_General_CP1_CI_AS NULL,
	CONSTRAINT PK__services__455070DF07400081 PRIMARY KEY (serviceId)
);

CREATE TABLE dbo.staffs (
	staffId int IDENTITY(1,1) NOT NULL,
	staffDepartment nvarchar(100) COLLATE SQL_Latin1_General_CP1_CI_AS NULL,
	staffPic nvarchar(255) COLLATE SQL_Latin1_General_CP1_CI_AS NULL,
	CONSTRAINT PK__staffs__6465E07E67484958 PRIMARY KEY (staffId)
);

CREATE TABLE dbo.towns (
	townID int NOT NULL,
	zoneCode int NULL,
	townDesc nvarchar(100) COLLATE SQL_Latin1_General_CP1_CI_AS NULL,
	townAbbrv nvarchar(10) COLLATE SQL_Latin1_General_CP1_CI_AS NULL,
	CONSTRAINT PK__towns__EFA664C67C984D71 PRIMARY KEY (townID)
);

CREATE TABLE dbo.bod (
	bodId int IDENTITY(1,1) NOT NULL,
	bodName nvarchar(100) COLLATE SQL_Latin1_General_CP1_CI_AS NULL,
	bodPosition nvarchar(255) COLLATE SQL_Latin1_General_CP1_CI_AS NULL,
	bodPicture nvarchar(255) COLLATE SQL_Latin1_General_CP1_CI_AS NULL,
	townId int NULL,
	CONSTRAINT PK__bod__B2549254A1268BE0 PRIMARY KEY (bodId),
	CONSTRAINT FK_bod_town FOREIGN KEY (townId) REFERENCES dbo.towns(townID)
);

CREATE TABLE dbo.consumers (
	consumerId int IDENTITY(1,1) NOT NULL,
	townId int NULL,
	routeCode int NULL,
	accountNum nvarchar(100) COLLATE SQL_Latin1_General_CP1_CI_AS NULL,
	lastname nvarchar(100) COLLATE SQL_Latin1_General_CP1_CI_AS NULL,
	firstname nvarchar(100) COLLATE SQL_Latin1_General_CP1_CI_AS NULL,
	midname nvarchar(100) COLLATE SQL_Latin1_General_CP1_CI_AS NULL,
	suffix nvarchar(50) COLLATE SQL_Latin1_General_CP1_CI_AS NULL,
	barangay nvarchar(100) COLLATE SQL_Latin1_General_CP1_CI_AS NULL,
	profilepix nvarchar(255) COLLATE SQL_Latin1_General_CP1_CI_AS NULL,
	backpix nvarchar(255) COLLATE SQL_Latin1_General_CP1_CI_AS NULL,
	registrationDate nvarchar(100) COLLATE SQL_Latin1_General_CP1_CI_AS NULL,
	contactNum nvarchar(100) COLLATE SQL_Latin1_General_CP1_CI_AS NULL,
	poleId nvarchar(100) COLLATE SQL_Latin1_General_CP1_CI_AS NULL,
	meterSRN nvarchar(100) COLLATE SQL_Latin1_General_CP1_CI_AS NULL,
	employeeName nvarchar(100) COLLATE SQL_Latin1_General_CP1_CI_AS NULL,
	[date] nvarchar(100) COLLATE SQL_Latin1_General_CP1_CI_AS NULL,
	[time] nvarchar(100) COLLATE SQL_Latin1_General_CP1_CI_AS NULL,
	transferrable nvarchar(100) COLLATE SQL_Latin1_General_CP1_CI_AS NULL,
	email nvarchar(100) COLLATE SQL_Latin1_General_CP1_CI_AS NULL,
	CONSTRAINT PK__consumer__B9581C8179833F58 PRIMARY KEY (consumerId),
	CONSTRAINT FK_consumers_towns FOREIGN KEY (townId) REFERENCES dbo.towns(townID)
);

CREATE TABLE dbo.employees (
	employeeId int IDENTITY(1,1) NOT NULL,
	firstname nvarchar(100) COLLATE SQL_Latin1_General_CP1_CI_AS NULL,
	midname nvarchar(100) COLLATE SQL_Latin1_General_CP1_CI_AS NULL,
	lastname nvarchar(100) COLLATE SQL_Latin1_General_CP1_CI_AS NULL,
	suffix nvarchar(50) COLLATE SQL_Latin1_General_CP1_CI_AS NULL,
	townId int NULL,
	contactNum nvarchar(100) COLLATE SQL_Latin1_General_CP1_CI_AS NULL,
	gender int NULL,
	positionId int DEFAULT 1 NOT NULL,
	CONSTRAINT PK__employee__C134C9C1FB41809D PRIMARY KEY (employeeId),
	CONSTRAINT FK_employees_positions FOREIGN KEY (positionId) REFERENCES dbo.positions(positionId),
	CONSTRAINT FK_employees_towns FOREIGN KEY (townId) REFERENCES dbo.towns(townID)
);

CREATE TABLE dbo.logs (
	logId int IDENTITY(1,1) NOT NULL,
	employeeId int NULL,
	logActivity nvarchar(255) COLLATE SQL_Latin1_General_CP1_CI_AS NULL,
	logDate datetime DEFAULT getdate() NULL,
	CONSTRAINT PK__logs__7839F64D736B5BE7 PRIMARY KEY (logId),
	CONSTRAINT FK_employee_logs FOREIGN KEY (employeeId) REFERENCES dbo.employees(employeeId)
);

CREATE TABLE dbo.routes (
	routeId int IDENTITY(1,1) NOT NULL,
	townId int NULL,
	routeCode varchar(100) COLLATE SQL_Latin1_General_CP1_CI_AS NULL,
	description text COLLATE SQL_Latin1_General_CP1_CI_AS NULL,
	CONSTRAINT PK__routes__BAC024C70E11AAEA PRIMARY KEY (routeId),
	CONSTRAINT FK_routes_towns FOREIGN KEY (townId) REFERENCES dbo.towns(townID)
);

CREATE TABLE dbo.accounts (
	accountId int IDENTITY(1,1) NOT NULL,
	consumerId int NULL,
	employeeId int NULL,
	username nvarchar(255) COLLATE SQL_Latin1_General_CP1_CI_AS NULL,
	password nvarchar(255) COLLATE SQL_Latin1_General_CP1_CI_AS NULL,
	positionId int NULL,
	registrationDate datetime DEFAULT getdate() NULL,
	accountStatusId int NULL,
	verificationCode int NULL,
	isActive int NULL,
	townId int DEFAULT 1 NOT NULL,
	email varchar(100) COLLATE SQL_Latin1_General_CP1_CI_AS NULL,
	CONSTRAINT PK__accounts__F267251E8E9C1E62 PRIMARY KEY (accountId),
	CONSTRAINT FK_accounts_accountStatus FOREIGN KEY (accountStatusId) REFERENCES dbo.accountStatus(accountStatusId),
	CONSTRAINT FK_accounts_consumers FOREIGN KEY (consumerId) REFERENCES dbo.consumers(consumerId),
	CONSTRAINT FK_accounts_employees FOREIGN KEY (employeeId) REFERENCES dbo.employees(employeeId),
	CONSTRAINT FK_accounts_positions FOREIGN KEY (positionId) REFERENCES dbo.positions(positionId),
	CONSTRAINT FK_accounts_towns FOREIGN KEY (townId) REFERENCES dbo.towns(townID)
);

CREATE TABLE dbo.bills (
	billId int IDENTITY(1,1) NOT NULL,
	consumerId int NULL,
	billYearMonth date NULL,
	billAmount int NULL,
	kwhUsed int NULL,
	orDate date NULL,
	orAmount int NULL,
	dueDate datetime NULL,
	disconnectionDate datetime NULL,
	CONSTRAINT PK__bills__6D903F03BD61B296 PRIMARY KEY (billId),
	CONSTRAINT FK_bills_consumer FOREIGN KEY (consumerId) REFERENCES dbo.consumers(consumerId)
);

CREATE TABLE dbo.complaints (
	complaintId int IDENTITY(1,1) NOT NULL,
	employeeId int NULL,
	townId int NULL,
	accountNum nvarchar(128) COLLATE SQL_Latin1_General_CP1_CI_AS NULL,
	landmark text COLLATE SQL_Latin1_General_CP1_CI_AS NULL,
	complaintDesc text COLLATE SQL_Latin1_General_CP1_CI_AS NULL,
	complaintDate datetime DEFAULT getdate() NULL,
	natureId int NULL,
	accountId int NULL,
	statusId int NULL,
	resolvedDate datetime NULL,
	CONSTRAINT PK__complain__5295255C0F577CF0 PRIMARY KEY (complaintId),
	CONSTRAINT FK_complains_complaintNature FOREIGN KEY (natureId) REFERENCES dbo.complaintNatures(natureId),
	CONSTRAINT FK_complains_employees FOREIGN KEY (employeeId) REFERENCES dbo.employees(employeeId),
	CONSTRAINT FK_complains_status FOREIGN KEY (statusId) REFERENCES dbo.complaintStatus(statusId),
	CONSTRAINT FK_complains_town FOREIGN KEY (townId) REFERENCES dbo.towns(townID),
	CONSTRAINT FK_complaints_accounts FOREIGN KEY (accountId) REFERENCES dbo.accounts(accountId) ON DELETE CASCADE
);

CREATE TABLE dbo.complaintAction (
	actionId int IDENTITY(1,1) NOT NULL,
	complaintId int NULL,
	actionDetails text COLLATE SQL_Latin1_General_CP1_CI_AS NULL,
	startDate datetime NULL,
	endDate datetime NULL,
	employeeId int NULL,
	CONSTRAINT PK__complain__004C68E3AB416013 PRIMARY KEY (actionId),
	CONSTRAINT FK_action_complains FOREIGN KEY (complaintId) REFERENCES dbo.complaints(complaintId)
);