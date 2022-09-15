DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `new_iom_analysis`(IN CaseId INT(11), IN FamilyBg TEXT, IN StateHistory TEXT, IN ProblemsSuggestions TEXT, IN ChildTotalState TEXT, IN OrgPrvInterventions TEXT, IN SuggestedMedcineEqp TEXT, IN CreatedUserId INT(11), OUT result INT)
BEGIN
declare Found int;
SELECT
  ID INTO Found
FROM iomanalysis
WHERE Case_id = CaseId;
  if(Found is null) then 
begin
INSERT INTO iomanalysis (Case_id
, Family_bg
, State_history
, Problems_suggestions
, Child_total_state
, Org_prv_interventions
  ,Suggested_medicine_equipment
, Created_userId
, Created_date)
  VALUES (CaseId, FamilyBg, StateHistory, ProblemsSuggestions, ChildTotalState, OrgPrvInterventions,SuggestedMedcineEqp, CreatedUserId, NOW());
set result=( SELECT
    MAX(ID)
  FROM iomanalysis);
UPDATE childcase
SET Iom_analysis_state = 1,
    Iom_analyst_id = CreatedUserId
WHERE ID = CaseId;

END;
ELSE
begin
UPDATE iomanalysis
SET Family_bg = FamilyBg,
    State_history = StateHistory,
    Problems_suggestions = ProblemsSuggestions,
    Child_total_state = ChildTotalState,
    Org_prv_interventions = OrgPrvInterventions,
   Suggested_medicine_equipment=SuggestedMedcineEqp,
    Modified_user_id = CreatedUserId,
    Modification_date = NOW()
WHERE Case_id = CaseId;
set result=Found;
UPDATE childcase
SET Iom_analysis_state = 1,
    Iom_analyst_id = CreatedUserId
WHERE ID = CaseId;
END;
END IF;
END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `new_iom_analysis_echo`(IN CaseId INT, IN FamilyEchoBg TEXT CHARSET UTF8, IN RequiredIntverntion TEXT CHARSET UTF8, IN CaseHistory TEXT, IN notes TEXT, IN CreatedUserId INT(11), OUT result INT(11))
    NO SQL
BEGIN
declare Found int;
SELECT
  ID INTO Found
FROM iomanalysisechnomic
WHERE Case_id = CaseId;
  if(Found is null) then 
begin
INSERT INTO iomanalysisechnomic (Case_id
, Family_echo_bg
, required_intervention
  ,Case_history
  ,Notes
, Created_userId
, Created_date)
  VALUES (CaseId, FamilyEchoBg, RequiredIntverntion,CaseHistory,notes, CreatedUserId, NOW());
set result=( SELECT
    MAX(ID)
  FROM iomanalysisechnomic);
UPDATE childcase
SET Iom_analysis_state = 1,
    Iom_analyst_id = CreatedUserId
WHERE ID = CaseId;

END;
ELSE
begin
UPDATE iomanalysisechnomic
SET  Family_echo_bg = FamilyEchoBg,
   required_intervention=RequiredIntverntion,
  Case_history=CaseHistory,
    Modified_user_id = CreatedUserId,
    Modification_date = NOW(),
    Notes=notes

WHERE Case_id = CaseId;
set result=Found;
UPDATE childcase
SET Iom_analysis_state = 1,
    Iom_analyst_id = CreatedUserId
  
 
   
WHERE ID = CaseId;
END;
END IF;
END$$
DELIMITER ;

DELIMITER $$
Alter PROCEDURE `new_childcaseanalysis`(IN IsExist INT(11), IN CaseAnalysisCase_id INT(11), IN CaseAnalysisCase_reason TEXT, IN CaseAnalysisLiving_status SMALLINT(6), IN CaseAnalysisVictim_state SMALLINT(6), IN CaseAnalysisCurrent_problem SMALLINT(6), IN CaseAnalysisOther_issues TEXT, IN CaseAnalysisSuggested_prc_by_referral_manager TEXT, IN CaseAnalysisSuggested_prc_by_phsyco_specialist TEXT, IN CaseAnalysisCreated_user INT(11), IN DisabilityState INT, IN DisabilityId INT, IN ProtecionIssues TEXT, OUT result INT)
BEGIN
declare found int;
set @found=0;
SELECT   ID INTO @found FROM  childcaseanalysis WHERE Case_id=CaseAnalysisCase_id;

if @found= 0 then
INSERT INTO childcaseanalysis (Case_id
, Case_reason
, Living_status
, Victim_state
, Current_problem
, Other_issues
, Suggested_prc_by_referral_manager
, Suggested_prc_by_phsyco_specialist
  , Disability_state
   ,Disability_id
  ,Protection_issues
, Created_user
, Created_date
  )
  VALUES (CaseAnalysisCase_id -- Case_id - INT(11)
  , CaseAnalysisCase_reason -- Case_reason - TEXT
  , CaseAnalysisLiving_status -- Living_status - SMALLINT(6)
  , CaseAnalysisVictim_state -- Victim_state - SMALLINT(6)
  , CaseAnalysisCurrent_problem -- Current_problem - SMALLINT(6)
  , CaseAnalysisOther_issues -- Other_issues - TEXT
  , CaseAnalysisSuggested_prc_by_referral_manager -- Suggested_prc_by_referral_manager - TEXT
  , CaseAnalysisSuggested_prc_by_phsyco_specialist -- Suggested_prc_by_phsyco_specialist - TEXT
   ,DisabilityState
   ,DisabilityId
  ,ProtecionIssues
  , CaseAnalysisCreated_user -- Created_user - INT(11)
  , NOW() -- Created_date - DATE
  );


  UPDATE childcase
SET Case_final_decision_id = 394,Specialist_id =CaseAnalysisCreated_user
WHERE ID = CaseAnalysisCase_id;
set result=( SELECT
    MAX(ID)

  FROM childcaseanalysis);

ELSE

UPDATE childcaseanalysis
SET Case_reason = CaseAnalysisCase_reason -- Case_reason - MEDIUMTEXT
    ,
    Living_status = CaseAnalysisLiving_status -- Living_status - SMALLINT(6)
    ,
    Victim_state = CaseAnalysisVictim_state -- Victim_state - SMALLINT(6)
    ,
    Current_problem = CaseAnalysisCurrent_problem -- Current_problem - SMALLINT(6)
    ,
    Other_issues = CaseAnalysisOther_issues -- Other_issues - MEDIUMTEXT
    ,
    Suggested_prc_by_referral_manager = CaseAnalysisSuggested_prc_by_referral_manager -- Suggested_prc_by_referral_manager - MEDIUMTEXT
    ,
    Suggested_prc_by_phsyco_specialist = CaseAnalysisSuggested_prc_by_phsyco_specialist -- Suggested_prc_by_phsyco_specialist - MEDIUMTEXT
    , Disability_state=DisabilityState
    , Disability_id=DisabilityId
    ,Protection_issues=ProtecionIssues
    , Modified_user_id = CaseAnalysisCreated_user -- Modified_user_id - INT(11)
    ,
    Modified_date = NOW() -- Modified_date - DATE
WHERE Case_id = CaseAnalysisCase_id;


set result=( SELECT
    ID
  FROM childcaseanalysis
  WHERE Case_id = CaseAnalysisCase_id);

END IF;
  

END$$



Alter PROCEDURE `new_child_registerant`(IN CareGiver_id INT(11), IN CareGiverFirst_name VARCHAR(255) CHARSET UTF8, IN CareGiverLast_name VARCHAR(255) CHARSET UTF8, IN IdentityNo VARCHAR(255) CHARSET UTF8, IN CareGiverGender SMALLINT(6), IN CareGiverPhone_no VARCHAR(255), IN Created_user INT(11), IN CareGiverFax_id VARBINARY(255), IN CareGiverEmail VARCHAR(50), IN Child_id INT(11), IN ChildFirst_name VARCHAR(255) CHARSET UTF8, IN ChildMiddel_name VARCHAR(255) CHARSET UTF8, IN ChildLast_name VARCHAR(255) CHARSET UTF8, IN ChildGender SMALLINT(6), IN ChildBirth_place INT(11), IN ChildLiving_governate INT(11), IN ChildLiving_district INT(11), IN ChildChildAddress VARCHAR(255) CHARSET UTF8, IN ChildCare_giver_relation_id INT(11), IN ChildMother_alive SMALLINT(6), IN ChildMother_name VARCHAR(255) CHARSET UTF8, IN ChildMother_work VARCHAR(255) CHARSET UTF8, IN ChildFather_alive SMALLINT(6), IN ChildFather_name VARCHAR(255) CHARSET UTF8, IN ChildFather_work VARCHAR(255) CHARSET UTF8, IN Case_id INT(11), IN CaseRequired_service TEXT CHARSET UTF8, IN ChildAge INT, IN Displaced_state SMALLINT, IN ChildSource INT, IN ChildNationality INT, OUT result INT)
BEGIN
declare ChildBirth_date date;
set ChildBirth_date=now();
IF Child_id = 0 THEN
BEGIN
 declare CareGiverPersonId int;
  declare CareGiverId int;
  declare ChildPersonId int;
  declare ChildId int;

INSERT INTO person (First_name,
Last_name,
Gender,
Phone_no,
Created_user,
Created_date)
  VALUES (CareGiverFirst_name, CareGiverLast_name, CareGiverGender, CareGiverPhone_no, Created_user, NOW());

 
set  @CareGiverPersonId=( SELECT
    MAX(ID)
  FROM person);

INSERT INTO caregiver (Person_id,
Fax_id,
Email,
Identity_no)
  VALUES (@CareGiverPersonId, CareGiverFax_id, CareGiverEmail, IdentityNo);

set @CareGiverId=( SELECT
    MAX(ID)
  FROM caregiver);

INSERT INTO person (First_name,
Last_name,
Gender,
Created_user,
Created_date)
  VALUES (ChildFirst_name, ChildLast_name, ChildGender, Created_user, NOW());
set ChildPersonId=( SELECT
    MAX(id)
  FROM person);
INSERT INTO child (Person_id,
Birth_date,
Birth_place,
Living_governate,
Living_district,
Address,
Care_giver_id,
Care_giver_relation_id,
Mother_alive,
Mother_name,
Mother_work,
Father_alive,
Father_name,
Father_work,
Middel_name,
Age,
Displaced,
Child_source,
 Nationality_id
  )
  VALUES (ChildPersonId, ChildBirth_date, ChildBirth_place, ChildLiving_governate, ChildLiving_district, ChildChildAddress, @CareGiverId, ChildCare_giver_relation_id, ChildMother_alive, ChildMother_name, ChildMother_work, ChildFather_alive, ChildFather_name, ChildFather_work, ChildMiddel_name, ChildAge, Displaced_state, ChildSource  ,ChildNationality);
  set ChildId=( SELECT
    MAX(id)
  FROM child);
set result=ChildId;
INSERT INTO childcase (Code2
, Child_id
, Created_date
, Created_user
, Case_final_decision_id
, diagnonist_id
, Specialist_id

, Required_service
  )
  VALUES ('' -- Code2 - VARCHAR(255)
  , ChildId -- Child_id - INT(11)
  , NOW() -- Created_date - DATE
  , Created_user -- Created_user - INT(11)
  , 0, 0 -- Case_final_decision_id - INT(11)
  , 0, CaseRequired_service -- Required_service - TEXT

  );
END;
ELSE
BEGIN

	declare CareGiverPersonId int;
	declare ChildPersonId int;
	set result=Child_id;
	set CareGiverPersonId=( SELECT
    Person_id
  FROM caregiver
  WHERE ID = CareGiver_id);
	set ChildPersonId=( SELECT
    Person_id
  FROM child
  WHERE ID = Child_id);

UPDATE person
SET First_name = CareGiverFirst_name -- First_name - VARCHAR(255)
    ,
    Last_name = CareGiverLast_name -- Last_name - VARCHAR(255)
    ,
    Gender = CareGiverGender -- Gender - SMALLINT(6)
    ,
    Phone_no = CareGiverPhone_no -- Phone_no - VARCHAR(255)
WHERE ID = CareGiverPersonId -- ID - INT(11) NOT NULL
;
UPDATE caregiver
SET Fax_id = CareGiverFax_id -- Fax_id - VARBINARY(255)
    ,
    Email = CareGiverEmail -- Email - VARCHAR(50)
    ,
    Identity_no = IdentityNo -- Identity_no - VARCHAR(255)
WHERE ID = CareGiver_id -- ID - INT(11) NOT NULL
;

UPDATE person
SET First_name = ChildFirst_name -- First_name - VARCHAR(255)
    ,
    Last_name = ChildLast_name -- Last_name - VARCHAR(255)
    ,
    Gender = ChildGender -- Gender - SMALLINT(6)
WHERE ID = ChildPersonId -- ID - INT(11) NOT NULL
;

UPDATE child
SET Birth_date = ChildBirth_date -- Birth_date - DATE
    ,
    Birth_place = ChildBirth_place -- Birth_place - INT(11)
    ,
    Living_governate = ChildLiving_governate -- Living_governate - INT(11)
    ,
    Living_district = ChildLiving_district -- Living_district - INT(11)
    ,
    Address = ChildChildAddress -- Address - VARCHAR(255)
    ,
    Care_giver_relation_id = ChildCare_giver_relation_id -- Care_giver_relation_id - INT(11)
    ,
    Mother_alive = ChildMother_alive -- Mother_alive - SMALLINT(6)
    ,
    Mother_name = ChildMother_name -- Mother_name - VARCHAR(255)
    ,
    Mother_work = ChildMother_work -- Mother_work - VARCHAR(255)
    ,
    Father_alive = ChildFather_alive -- Father_alive - SMALLINT(6)
    ,
    Father_name = ChildFather_name -- Father_name - VARCHAR(255)
    ,
    Father_work = ChildFather_work -- Father_work - VARCHAR(255)
    ,
    Middel_name = ChildMiddel_name -- Middel_name - VARCHAR(255)
    ,
    Age = ChildAge,
    Displaced = Displaced_state,
    Child_source = ChildSource,
  Nationality_id=ChildNationality
WHERE ID = Child_id -- ID - INT(11) NOT NULL
;

UPDATE childcase
SET Modified_date = NOW() -- Modified_date - DATE
    ,
    Modified_user_id = Created_user -- Modified_user_id - INT(11)
    ,
    Required_service = CaseRequired_service -- Required_service - TEXT
WHERE ID = Case_id -- ID - INT(11) NOT NULL
;

END;
END IF;
END$$
DELIMITER ;