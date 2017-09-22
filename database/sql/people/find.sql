SELECT
    people.id AS person_id,
    people.name AS person_name,
    age,
    jobs.id AS job_id,
    job_type,
    companies.id AS company_id,
    companies.name AS company_name
FROM people
LEFT JOIN jobs ON people.id = jobs.person_id
LEFT JOIN companies ON jobs.company_id = companies.id;
