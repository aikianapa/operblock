SELECT
            Event.id AS eventId,firstName,patrName,lastName,externalId,Action.begDate,Client.birthDate , Action.`person_id` AS person_id, OSHB.code AS bedCodeName

                      FROM Action
                      INNER JOIN ActionType ON ActionType.`id`=Action.`actionType_id` 
                        LEFT JOIN ActionProperty AS ap_bed ON (Action.id = ap_bed.action_id AND ap_bed.type_id=(SELECT id FROM `ActionPropertyType` WHERE `name` LIKE 'койка' AND actionType_id = ActionType.id AND deleted = 0 LIMIT 1) AND ap_bed.deleted =0)
                        LEFT JOIN ActionProperty_HospitalBed AS APHB ON (APHB.id=ap_bed.id)
			LEFT JOIN OrgStructure_HospitalBed AS OSHB ON OSHB.id=APHB.value
                        INNER JOIN Event ON Action.`event_id`=Event.`id`
                        INNER JOIN Client ON (Event.`client_id`=Client.`id`)
                        LEFT JOIN ActionPropertyType ON ActionPropertyType.`actionType_id`=ActionType.`id`
                        LEFT JOIN ActionProperty ON ActionProperty.`type_id`=ActionPropertyType.`id`
                        LEFT JOIN vrbPersonWithSpeciality ON vrbPersonWithSpeciality.`id`=Action.`person_id`
                        LEFT JOIN ActionProperty_OrgStructure AS ap_os ON ap_os.`id`=ActionProperty.`id`
                        INNER JOIN EventType ON Event.`eventType_id`=EventType.`id`
                        LEFT JOIN Contract ON Contract.`id`=Event.`contract_id`
                        LEFT JOIN rbFinance ON rbFinance.`id`=Contract.`finance_id`


                    WHERE (Action.`actionType_id` IN (SELECT `id` FROM `ActionType` WHERE `flatCode`='moving') )
                        AND APHB.value IS NULL
                        AND (Action.`deleted`=0)
                        AND (Event.`deleted`=0)
                        AND (ActionProperty.`deleted`=0)
                        AND (Client.`deleted`=0)
                        AND (ActionProperty.`action_id`=Action.`id`)
                        AND ((EventType.medicalAidType_id IN (SELECT rbMedicalAidType.id from rbMedicalAidType where rbMedicalAidType.code IN ('1', '2', '3', '7'))))
                        AND (ActionPropertyType.`name` LIKE 'Отделение пребывания')
                        AND ((Action.endDate IS NULL) OR (Action.endDate = 0))
                        AND  (ap_os.`value`={$orgStructure_id})

        ORDER BY {$sortBy} {$sortOrder}
