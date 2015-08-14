SELECT 
    Event.id AS eventId,firstName,patrName,lastName,externalId,Action.begDate,Client.birthDate , Action.`person_id` AS person_id,
	ap_ostr.code as OrgStructure_name,
			(SELECT OSHB.code
                FROM ActionPropertyType AS APT
                INNER JOIN ActionProperty AS AP ON AP.type_id=APT.id
                INNER JOIN ActionProperty_HospitalBed AS APHB ON APHB.id=AP.id
                INNER JOIN OrgStructure_HospitalBed AS OSHB ON OSHB.id=APHB.value
                WHERE APT.actionType_id=Action.actionType_id
                AND AP.action_id=Action.id AND AP.deleted=0
                AND APT.deleted=0 AND APT.typeName LIKE 'HospitalBed' AND AP.deleted=0
            )  AS palata,
            (SELECT ap_os.value
	    		FROM Action AS current
				INNER JOIN ActionProperty AS ap ON (ap.action_id = current.id)
				INNER JOIN ActionPropertyType AS apt ON (apt.id = ap.type_id AND name='Переведен в отделение')
				INNER JOIN ActionProperty_OrgStructure AS ap_os ON (ap_os.id = ap.id)
				WHERE current.id = Action.id AND ap.deleted=0
		  ) AS `toOrgStructure_id`,
            (SELECT a5.id
				FROM `Job_Ticket` as a1 
				INNER JOIN Job as a2 ON (a1.master_id=a2.id)
				INNER JOIN ActionProperty_Job_Ticket as a33 ON (a33.value=a1.id)
				INNER JOIN ActionProperty as a4 ON (a33.id=a4.id)
				INNER JOIN Action as a5 ON (a4.action_id=a5.id)
				INNER JOIN ActionType as a12 ON (a5.actionType_id=a12.id)
				WHERE resTimestamp>0 AND a2.deleted=0 AND a5.deleted=0
				AND a12.deleted =0 AND a5.event_id=Action.event_id AND a2.orgStructure_id='{$orgStructure_id}' AND a5.createPerson_id!='{$user_id}' AND (a5.person_id='{$user_id}' OR a1.status<2 OR 'head'='{$profile}')
AND (( datetime >= '{$startDate}' AND datetime < '{$endDate}' ) OR ( a1.status < 2 AND datetime < '{$todayDate}' ) )
				ORDER BY a1.status, datetime LIMIT 1
				) AS `consult_id`,
            (SELECT a1.status
				FROM `Job_Ticket` as a1 
				INNER JOIN Job as a2 ON (a1.master_id=a2.id)
				INNER JOIN ActionProperty_Job_Ticket as a33 ON (a33.value=a1.id)
				INNER JOIN ActionProperty as a4 ON (a33.id=a4.id)
				INNER JOIN Action as a5 ON (a4.action_id=a5.id)
				INNER JOIN ActionType as a12 ON (a5.actionType_id=a12.id)
				WHERE resTimestamp>0 AND a2.deleted=0 AND a5.deleted=0
				AND a12.deleted =0 AND a5.event_id=Action.event_id AND a2.orgStructure_id='{$orgStructure_id}' AND a5.createPerson_id!='{$user_id}' AND (a5.person_id='{$user_id}' OR a1.status<2 OR 'head'='{$profile}')
AND (( datetime >= '{$startDate}' AND datetime < '{$endDate}' ) OR ( a1.status < 2 AND datetime < '{$todayDate}' ) )				
				ORDER BY a1.status, datetime LIMIT 1
				) AS `consult`, 
           (SELECT datetime
				FROM `Job_Ticket` as a1 
				INNER JOIN Job as a2 ON (a1.master_id=a2.id)
				INNER JOIN ActionProperty_Job_Ticket as a33 ON (a33.value=a1.id)
				INNER JOIN ActionProperty as a4 ON (a33.id=a4.id)
				INNER JOIN Action as a5 ON (a4.action_id=a5.id)
				INNER JOIN ActionType as a12 ON (a5.actionType_id=a12.id)
				WHERE resTimestamp>0 AND a2.deleted=0 AND a5.deleted=0 
				AND a12.deleted =0 AND a5.event_id=Action.event_id AND a2.orgStructure_id='{$orgStructure_id}' AND a5.createPerson_id!='{$user_id}' AND (a5.person_id='{$user_id}' OR a1.status<2 OR 'head'='{$profile}')
AND (( datetime >= '{$startDate}' AND datetime < '{$endDate}' ) OR ( a1.status < 2 AND datetime < '{$todayDate}' ) )				
				ORDER BY a1.status, datetime LIMIT 1
				) AS `consult_datetime`
             FROM Action
             INNER JOIN ActionType ON ActionType.`id`=Action.`actionType_id`
             INNER JOIN ActionProperty AS ap_bed ON (Action.id = ap_bed.action_id AND ap_bed.type_id=(SELECT id FROM `ActionPropertyType` WHERE `name` LIKE 'койка' AND deleted = 0 LIMIT 1) AND ap_bed.deleted =0)
             INNER JOIN ActionProperty_HospitalBed AS ap_bed2 ON (ap_bed2.id=ap_bed.id)
             INNER JOIN Event ON Action.`event_id`=Event.`id`
             INNER JOIN Client ON (Event.`client_id`=Client.`id`)
             
             LEFT JOIN ActionPropertyType ON ActionPropertyType.`actionType_id`=ActionType.`id`
             LEFT JOIN ActionProperty ON ActionProperty.`type_id`=ActionPropertyType.`id`
             LEFT JOIN vrbPersonWithSpeciality ON vrbPersonWithSpeciality.`id`=Action.`person_id`
             LEFT JOIN ActionProperty_OrgStructure AS ap_os ON ap_os.`id`=ActionProperty.`id`
             LEFT JOIN OrgStructure AS ap_ostr ON ap_ostr.`id`=ap_os.value
             INNER JOIN EventType ON Event.`eventType_id`=EventType.`id`

WHERE (Action.`actionType_id` IN (SELECT `id` FROM `ActionType` WHERE `flatCode`='moving') )
             AND (Action.`deleted`=0)
             AND (Event.`deleted`=0)
             AND (ActionProperty.`deleted`=0)
             AND (Client.`deleted`=0)
             AND ActionType.deleted=0
             AND (ActionProperty.`action_id`=Action.`id`)
             AND ((EventType.medicalAidType_id IN (SELECT rbMedicalAidType.id from rbMedicalAidType where rbMedicalAidType.code IN ('1', '2', '3', '7'))))
             AND (ActionPropertyType.`name` LIKE 'Отделение пребывания')
             AND (Action.`endDate` IS NULL)
             {$search}
HAVING toOrgStructure_id IS NULL AND consult IS NOT NULL AND 
	(( consult_datetime >= '{$startDate}' AND consult_datetime < '{$endDate}' ) OR ( consult < 2 AND consult_datetime < '{$todayDate}' ) )
ORDER BY {$sortBy} {$sortOrder}
