select r.name,p.name from roles as r
                             left join role_has_permissions as rhp on rhp.role_id = r.id
                             left join permissions as p on p.id = rhp.permission_id
