SELECT
    locations.id AS location_id,
    street,
    city,
    state,
    people.id AS person_id,
    name,
    age
FROM locations
LEFT JOIN people ON locations.id = people.home_id
ORDER BY locations.id
