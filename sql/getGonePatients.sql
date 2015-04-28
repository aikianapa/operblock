SELECT
            Event.id AS eventId,
            firstName,
            patrName,
            lastName,
            externalId,
            Action.begDate,
            Client.birthDate,
            (SELECT ap_s.value
						FROM Action AS current
						INNER JOIN ActionProperty AS ap ON (ap.action_id = current.id)
						INNER JOIN ActionPropertyType AS apt ON (apt.id = ap.type_id AND name='Исход госпитализации')
						INNER JOIN ActionProperty_String AS ap_s ON (ap_s.id = ap.id)
						WHERE current.id = Action.id  AND ap.deleted=0
					) AS moveAwayCause




             FROM Action
             INNER JOIN ActionType ON ActionType.`id`=Action.`actionType_id`
             INNER JOIN Event ON Action.`event_id`=Event.`id`
             INNER JOIN Client ON (Event.`client_id`=Client.`id`)
             LEFT JOIN ActionPropertyType ON ActionPropertyType.`actionType_id`=ActionType.`id`
             LEFT JOIN ActionProperty ON ActionProperty.`type_id`=ActionPropertyType.`id`
             LEFT JOIN vrbPersonWithSpeciality ON vrbPersonWithSpeciality.`id`=Action.`person_id`
             LEFT JOIN ActionProperty_OrgStructure ON ActionProperty_OrgStructure.`id`=ActionProperty.`id`
             LEFT JOIN OrgStructure ON OrgStructure.`id`=ActionProperty_OrgStructure.`value`
             INNER JOIN EventType ON Event.`eventType_id`=EventType.`id`


                    WHERE (Action.`actionType_id` IN (SELECT `id` FROM `ActionType` WHERE `flatCode`='leaved') )
                        AND (Action.`deleted`=0)
                        AND (Event.`deleted`=0)
                        AND (Event.`eventType_id` IN {$eventType_id})
                        AND (Event.`execDate` IS NULL)
                        AND (ActionProperty.`deleted`=0)
                        AND (Client.`deleted`=0)
                        AND (ActionProperty.`action_id`=Action.`id`)
                        AND ((EventType.medicalAidType_id IN (SELECT rbMedicalAidType.id from rbMedicalAidType where rbMedicalAidType.code IN ('1', '2', '3', '7'))))
                        AND (ActionPropertyType.`name` LIKE 'Отделение')
                        AND  (OrgStructure.`id`={$orgStructure_id})

        ORDER BY {$sortBy} {$sortOrder}
