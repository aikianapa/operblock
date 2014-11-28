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
            (SELECT a1.begDate
				FROM `Action` as a1 
				WHERE actionType_id={$dutyType_id} AND a1.deleted=0 AND a1.signature=0
				AND a1.begDate<'{$tomorrow}'
				ORDER BY a1.signature, a1.begDate DESC LIMIT 1
				) AS `duty_begDate`,
            (SELECT (CASE WHEN a1.begDate LIKE '{$today}%' THEN 1 WHEN a1.begDate<'{$today}' THEN 2 ELSE 0 END)
				FROM `Action` as a1 
				WHERE actionType_id={$dutyType_id} AND a1.deleted=0 AND a1.signature=0
				AND a1.begDate<'{$tomorrow}' AND event_id=Action.event_id
				ORDER BY a1.signature, a1.begDate DESC LIMIT 1
				) AS `duty`
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
             AND (ActionProperty.`action_id`=Action.`id`)
             AND ((EventType.medicalAidType_id IN (SELECT rbMedicalAidType.id from rbMedicalAidType where rbMedicalAidType.code IN ('1', '2', '3', '7'))))
             AND (ActionPropertyType.`name` LIKE 'Отделение пребывания')
             AND (Action.`endDate` IS NULL)
             {$search}
HAVING toOrgStructure_id IS NULL AND duty>0
ORDER BY {$sortBy} {$sortOrder}
