SELECT
    people.id AS person_id,
    people.name AS person_name,
    age,
    locations.id as location_id,
    locations.street,
    locations.city,
    locations.state,
    jobs.id AS job_id,
    job_type,
    companies.id AS company_id,
    companies.name AS company_name
FROM people
LEFT JOIN locations ON people.home_id = locations.id
LEFT JOIN jobs ON people.id = jobs.person_id
LEFT JOIN companies ON jobs.company_id = companies.id
ORDER BY people.id ASC
