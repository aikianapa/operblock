SELECT
            Event.id AS eventId,firstName,patrName,lastName,externalId,Action.begDate,Client.birthDate , Action.`person_id` AS person_id,
            (SELECT value
                  FROM `Action` as atemp
                  INNER JOIN ActionPropertyType as atemp2
                  INNER JOIN ActionProperty as atemp3 ON (atemp3.type_id=atemp2.id)
                  INNER JOIN ActionProperty_Temperature as atemp4 ON (atemp4.id=atemp3.id)
                  WHERE atemp.event_id=eventId AND atemp.`actionType_id`={$temperatureActionType} AND atemp.BegDate='{$morning}'
                  AND atemp3.action_id=atemp.id
                  AND atemp2.actionType_id = {$temperatureActionType} AND atemp2.name='Температура'
            ) as temperatureMorning,

			(SELECT value
                FROM `Action` as atemp
                INNER JOIN ActionPropertyType as atemp2
                INNER JOIN ActionProperty as atemp3 ON (atemp3.type_id=atemp2.id)
                INNER JOIN ActionProperty_Temperature as atemp4 ON (atemp4.id=atemp3.id)
                WHERE atemp.event_id=eventId AND atemp.`actionType_id`={$temperatureActionType} AND atemp.BegDate='{$evening}'
                AND atemp3.action_id=atemp.id
                AND atemp2.actionType_id = {$temperatureActionType} AND atemp2.name='Температура'
           ) as temperatureEvening,

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
		  
		  (SELECT `rbDiet`.code
				FROM `Event_Feed`
				INNER JOIN `rbDiet` ON (diet_id=`rbDiet`.id)
				INNER JOIN `rbMealTime` ON (mealTime_id=`rbMealTime`.id)
				WHERE `Event_Feed`.event_id=Action.event_id AND `Event_Feed`.deleted=0
				AND date='{$today} 00:00:00' LIMIT 1) as feed,

		  (SELECT `rbPhysicalActivityMode`.name
				FROM `Event_PhysicalActivity`
				INNER JOIN `rbPhysicalActivityMode` ON (physicalActivityMode_id=`rbPhysicalActivityMode`.id)
				WHERE `Event_PhysicalActivity`.event_id=Action.event_id AND `Event_PhysicalActivity`.deleted=0
				AND date='{$today} 00:00:00' LIMIT 1) as mode

             FROM Action
             INNER JOIN ActionType ON ActionType.`id`=Action.`actionType_id`
             INNER JOIN ActionProperty AS ap_bed ON (Action.id = ap_bed.action_id AND ap_bed.type_id=(SELECT id FROM `ActionPropertyType` WHERE `name` LIKE 'койка' AND actionType_id = ActionType.id AND deleted = 0 LIMIT 1) AND ap_bed.deleted =0)
             INNER JOIN ActionProperty_HospitalBed AS ap_bed2 ON (ap_bed2.id=ap_bed.id)
             INNER JOIN Event ON Action.`event_id`=Event.`id`
             INNER JOIN Client ON (Event.`client_id`=Client.`id`)
             LEFT JOIN ActionPropertyType ON ActionPropertyType.`actionType_id`=ActionType.`id`
             LEFT JOIN ActionProperty ON ActionProperty.`type_id`=ActionPropertyType.`id`
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
                        AND (ActionPropertyType.`name` LIKE 'Отделение пребывания')
                        AND (Action.`endDate` IS NULL)
                        AND  (ap_os.value={$orgStructure_id})
        HAVING toOrgStructure_id IS NULL
        ORDER BY {$sortBy} {$sortOrder}
