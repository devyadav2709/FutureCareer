CREATE TABLE career_recomdation (
    field VARCHAR(100),                        -- Example: Engineering
    domain VARCHAR(100),                       -- Example: Mechanical Engineering
    technical_skill VARCHAR(100),              -- Example: AutoCAD

    best_colleges TEXT,                        -- Comma-separated list or JSON

    core_subjects TEXT,                        -- Comma-separated list
    recommended_books TEXT,                    -- Comma-separated or JSON
    online_courses TEXT,                       -- Course platform & name in JSON or CSV format

    youtube_channels TEXT,                     -- Comma-separated or JSON with title & link
    websites TEXT,                             -- Study or official sites

    placement_info TEXT,                       -- Summary of placement status

    job_roles TEXT,                            -- List of job roles
    job_status TEXT,                           -- Current job opportunity trend

    salary_info TEXT,                          -- Starting, mid-level, and experienced salary data

    training_internship TEXT,                  -- Companies offering internships
    career_path TEXT,                          -- Growth stages
    certifications TEXT                        -- List of valuable certificates
);
