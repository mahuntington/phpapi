SELECT
    companies.id AS company_id,
    companies.name AS company_name,
    jobs.id AS job_id,
    job_type,
    people.id AS person_id,
    people.name AS person_name,
    age
FROM companies
LEFT JOIN jobs ON companies.id = jobs.company_id
LEFT JOIN people ON jobs.person_id = people.id;
