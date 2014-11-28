SELECT
            Event.id AS eventId,
            firstName,patrName,
            lastName,externalId,
            Action.begDate,
            Client.birthDate ,
            Action.`person_id` AS person_id,
	    OSHB.code AS bedCodeName,

            (SELECT ap_os.value
	    		FROM Action AS current
				INNER JOIN ActionProperty AS ap ON (ap.action_id = current.id)
				INNER JOIN ActionPropertyType AS apt ON (apt.id = ap.type_id AND name='Отделение пребывания')
				INNER JOIN ActionProperty_OrgStructure AS ap_os ON (ap_os.id = ap.id)
				WHERE current.id = Action.id   AND   ap.deleted=0
		  ) AS `fromOrgStructure_id`



             FROM Action
             INNER JOIN ActionType ON ActionType.`id`=Action.`actionType_id`
             INNER JOIN Event ON Action.`event_id`=Event.`id`
             INNER JOIN Client ON (Event.`client_id`=Client.`id`)
             LEFT JOIN ActionPropertyType ON ActionPropertyType.`actionType_id`=ActionType.`id`
             LEFT JOIN ActionProperty ON ActionProperty.`type_id`=ActionPropertyType.`id`
	     LEFT JOIN ActionProperty_HospitalBed AS APHB ON (APHB.id=ActionProperty.id)
             INNER JOIN OrgStructure_HospitalBed AS OSHB ON OSHB.id=APHB.value
             LEFT JOIN vrbPersonWithSpeciality ON vrbPersonWithSpeciality.`id`=Action.`person_id`
             LEFT JOIN ActionProperty_OrgStructure AS ap_os ON ap_os.`id`=ActionProperty.`id`
             INNER JOIN EventType ON Event.`eventType_id`=EventType.`id`


                    WHERE (Action.`actionType_id` IN (SELECT `id` FROM `ActionType` WHERE `flatCode`='moving') )
                        AND (Action.`deleted`=0)
                        AND (Event.`deleted`=0)
                        AND (ActionProperty.`deleted`=0)
                        AND (Client.`deleted`=0)
                        AND (ActionProperty.`action_id`=Action.`id`)
                        AND ((EventType.medicalAidType_id IN (SELECT rbMedicalAidType.id from rbMedicalAidType where rbMedicalAidType.code IN ('1', '2', '3', '7'))))
                        AND (ActionPropertyType.`name` LIKE 'Переведен в отделение')
                        AND (Action.`endDate` IS NULL)
                        AND  (ap_os.value={$orgStructure_id})
        ORDER BY {$sortBy} {$sortOrder}
