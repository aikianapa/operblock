SELECT
            Event.id AS eventId,
            firstName,
            patrName,
            lastName,
            externalId,
            Action.begDate,
            Client.birthDate , 
            Action.`person_id` AS person_id,
            (SELECT ap_os.value
						FROM Action AS current
						INNER JOIN ActionProperty AS ap ON (ap.action_id = current.id)
						INNER JOIN ActionPropertyType AS apt ON (apt.id = ap.type_id AND name='Переведен в отделение')
						INNER JOIN ActionProperty_OrgStructure AS ap_os ON (ap_os.id = ap.id)
						WHERE current.id = Action.id  AND ap.deleted=0
					) AS `toOrgStructure_id`

             FROM Action
             INNER JOIN ActionType ON ActionType.`id`=Action.`actionType_id`
             INNER JOIN Event ON Action.`event_id`=Event.`id`
             INNER JOIN Client ON (Event.`client_id`=Client.`id`)
             LEFT JOIN ActionPropertyType AS apt ON apt.`actionType_id`=ActionType.`id`
             LEFT JOIN ActionProperty  AS ap ON ap.`type_id`=apt.`id`

             LEFT JOIN vrbPersonWithSpeciality ON vrbPersonWithSpeciality.`id`=Action.`person_id`
             LEFT JOIN ActionProperty_OrgStructure AS ap_os ON ap_os.`id`=ap.`id`


             INNER JOIN EventType ON Event.`eventType_id`=EventType.`id`


                    WHERE (Action.`actionType_id` IN (SELECT `id` FROM `ActionType` WHERE `flatCode`='moving') )
                        AND (Action.`deleted`=0)
                        AND (Event.`deleted`=0)
                        AND (ap.`deleted`=0)
                        AND (Client.`deleted`=0)
                        AND (ap.`action_id`=Action.`id`)
                        AND ((EventType.medicalAidType_id IN (SELECT rbMedicalAidType.id from rbMedicalAidType where rbMedicalAidType.code IN ('1', '2', '3', '7'))))
                        AND (apt.`name` LIKE 'Отделение пребывания')

                        AND (Action.`endDate` IS NULL)
                        AND  (ap_os.`value`={$orgStructure_id})
        HAVING toOrgStructure_id IS NOT NULL
        ORDER BY {$sortBy} {$sortOrder}
