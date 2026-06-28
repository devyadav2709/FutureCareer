const domainOptions = {
    engineering: {
        "Mechanical Engineering": ["AutoCAD", "SolidWorks", "MATLAB", "CNC Programming", "Thermodynamics"],
        "Civil Engineering": ["AutoCAD Civil 3D", "Revit", "STAAD Pro", "Estimation & Costing"],
        "Electrical Engineering": ["Circuit Design", "PLC", "SCADA", "MATLAB", "Power Systems"],
        "Electronics & Communication": ["VLSI Design", "Embedded Systems", "PCB Design", "IoT", "MATLAB"],
        "Computer Science / IT": ["Programming (C++, Java, Python)", "DBMS", "OS", "DSA", "Git"],
        "Chemical Engineering": ["Process Simulation (Aspen HYSYS)", "Heat Transfer", "Lab Skills"],
        "Aerospace Engineering": ["CAD (CATIA, ANSYS)", "Aerodynamics", "Flight Simulation"],
        "Mechatronics": ["Arduino", "Raspberry Pi", "Robotics", "Sensors", "Control Systems"],
        "Robotics": ["ROS", "Python", "Robotic Arm Programming", "AI in Robotics"],
        "Biotechnology": ["Lab Techniques (PCR, ELISA)", "Bioinformatics", "Cell Culture"],
        "Petroleum Engineering": ["Drilling Tech", "Reservoir Simulation", "Petrochemical Software"],
        "Environmental Engineering": ["GIS", "Remote Sensing", "Wastewater Treatment", "AutoCAD"]
    },
    science: {
        "Physics": ["Lab Equipment Handling", "MATLAB", "Quantum Simulators"],
        "Chemistry": ["Titration", "Spectroscopy", "Chromatography"],
        "Biology": ["Microscopy", "Genetic Analysis", "Wet Lab Techniques"],
        "Mathematics": ["MATLAB", "R Programming", "LaTeX", "Data Analysis"],
        "Zoology / Botany": ["Taxonomy Tools", "Specimen dreadful", "Field Survey"],
        "Microbiology": ["Staining Techniques", "Culture Maintenance", "Autoclave Use"],
        "Biochemistry": ["Enzyme Assays", "Western Blotting", "DNA Isolation"],
        "Environmental Science": ["GIS", "Remote Sensing", "Pollution Monitoring Instruments"],
        "Forensic Science": ["DNA Analysis", "Crime Scene Investigation", "Fingerprinting"],
        "Earth Science / Geology": ["GIS Mapping", "Seismic Data Analysis", "Mineral Identification"]
    },
    commerce: {
        "Accounting / Finance": ["Tally ERP", "Excel (Advanced)", "SAP", "QuickBooks"],
        "Marketing": ["Digital Marketing", "SEO", "Google Ads", "CRM Tools"],
        "HR": ["HRMS Software", "Payroll Management", "Talent Acquisition Tools"],
        "Business Administration": ["MS Excel", "MIS Reports", "Business Analytics"],
        "Economics": ["Data Analysis (SPSS, R)", "Economic Forecasting"],
        "International Business": ["Foreign Exchange Tools", "Global Market Analysis"],
        "Entrepreneurship": ["Business Plan Tools", "Pitch Deck Creation", "Market Research"],
        "Supply Chain Management": ["SAP SCM", "Inventory Tools", "Logistics Software"]
    },
    medical: {
        "MBBS / BDS / Nursing": ["Patient Monitoring Systems", "EMR Software"],
        "Pharmacy": ["Drug Dispensing Tools", "Pharma Software"],
        "Physiotherapy": ["Therapy Equipment", "Rehabilitation Tools"],
        "Public Health": ["Data Analysis (Epi Info)", "SPSS"],
        "Lab Technology": ["Microscopy", "Blood Analysis Tools"],
        "Radiology": ["MRI/CT Imaging Software", "PACS"],
        "Ayurveda / Homeopathy": ["Herbal Extraction Tools", "Case Recording"],
        "Veterinary Science": ["Animal Care Equipment", "Lab Analysis Tools"]
    },
    design: {
        "Fashion Design": ["Adobe Illustrator", "Pattern Making"],
        "Graphic Design": ["Photoshop", "Illustrator", "Canva"],
        "Interior Design": ["AutoCAD", "SketchUp", "3DS Max"],
        "Animation & VFX": ["Blender", "After Effects", "Maya"],
        "UI/UX Design": ["Figma", "Adobe XD", "Wireframing"],
        "Photography": ["Lightroom", "DSLR Handling", "Editing Tools"],
        "Film Making": ["Premiere Pro", "Script Writing Tools"],
        "Architecture": ["AutoCAD", "Revit", "Rhino", "Lumion"]
    },
    education: {
        "B.Ed / M.Ed": ["Smart Classroom Tools", "LMS Platforms"],
        "Early Childhood Ed": ["Teaching Aids", "Activity-Based Learning"],
        "Special Education": ["Assistive Tech Tools", "Sign Language"],
        "Curriculum Design": ["Instructional Design Tools", "SCORM"],
        "Online Education": ["Moodle", "Google Classroom", "Zoom"],
        "Language Teaching": ["Duolingo", "Language Lab Tools"]
    },
    law: {
        "Corporate / Criminal Law": ["Legal Drafting Tools", "LexisNexis", "Manupatra"],
        "Cyber Law": ["Cybersecurity Basics", "IT Act Tools"],
        "Intellectual Property": ["Patent Filing Tools", "IPR Databases"],
        "Constitutional Law": ["Legal Research Platforms"]
    },
    agriculture: {
        "Agriculture Science": ["Soil Testing", "Crop Simulation Tools"],
        "Horticulture": ["Garden Design Tools", "Pest Control Tools"],
        "Forestry": ["Forest Mapping", "GIS"],
        "Fisheries": ["Aquaculture Tech", "GPS Tracking"],
        "Agribusiness": ["Farm ERP", "Inventory Tools"],
        "Environmental Studies": ["EIA Tools", "Pollution Monitoring Devices"]
    },
    hospitality: {
        "Hotel Management": ["PMS Software", "POS Systems"],
        "Tourism Management": ["Tour Planning Tools", "CRM"],
        "Travel & Airline Services": ["GDS (Amadeus, Galileo)", "Booking Systems"],
        "Culinary Arts": ["Kitchen Equipment Handling", "Food Safety"],
        "Event Management": ["Event Planning Software", "Budgeting Tools"]
    },
    vocational: {
        "Electrician": ["Wiring Tools", "Circuit Tester", "Electrical Safety"],
        "Plumbing": ["Pipe Fitting", "Leak Detection Tools"],
        "Automotive Technician": ["Engine Diagnostics", "AutoCAD", "Mechanic Tools"],
        "Welding": ["Arc Welding", "MIG Welding", "Blueprint Reading"],
        "Carpentry": ["Measurement Tools", "Power Tools"],
        "Beauty & Wellness": ["Makeup Tools", "Salon Equipment"],
        "Fashion Tailoring": ["Stitching Machine", "Pattern Drafting"],
        "Digital Marketing": ["SEO Tools", "Google Analytics", "Email Marketing"],
        "Mobile Repair": ["Soldering Tools", "Diagnosis Software"],
        "Photography": ["DSLR Use", "Editing Software"]
    },
    computer: {
        "Software Development": ["Python", "Java", "C#", "JavaScript", "SQL", "Git", "Agile Methodologies"],
        "Web Development (Frontend)": ["HTML", "CSS", "JavaScript", "React", "Angular", "Vue.js", "Responsive Design"],
        "Web Development (Backend)": ["Node.js", "Python (Django/Flask)", "Ruby on Rails", "PHP", "APIs", "Database Management"],
        "Data Science / Analytics": ["Python (Pandas, NumPy)", "R", "SQL", "Machine Learning", "Data Visualization (Tableau, Power BI)"],
        "Cybersecurity": ["Network Security", "Ethical Hacking", "Penetration Testing", "Security Auditing", "Incident Response"],
        "Cloud Computing": ["AWS", "Azure", "Google Cloud Platform", "Docker", "Kubernetes"],
        "AI / Machine Learning": ["TensorFlow", "PyTorch", "Scikit-learn", "Natural Language Processing (NLP)", "Computer Vision"],
        "Game Development": ["Unity", "Unreal Engine", "C++", "Game Design Principles", "3D Modeling"],
        "IT Support / Networking": ["Troubleshooting", "Network Protocols", "Hardware Maintenance", "Operating System Administration"]
    }
};

function populateDomains() {
    const mainField = document.getElementById("mainField");
    const domainSelect = document.getElementById("domain");

    domainSelect.innerHTML = '<option value="" selected disabled>Select Domain</option>';
    document.getElementById("skillsBox").innerHTML = '<option value="" selected disabled>Select your primary technical skill</option>';

    if (mainField && mainField.value && domainOptions[mainField.value]) {
        const domains = Object.keys(domainOptions[mainField.value]);
        domains.forEach(function (domain) {
            const option = document.createElement("option");
            option.value = domain;
            option.textContent = domain;
            domainSelect.appendChild(option);
        });
    }
}

function populateSkills() {
    const mainField = document.getElementById("mainField");
    const domainSelect = document.getElementById("domain");
    const skillsSelect = document.getElementById("skillsBox");

    skillsSelect.innerHTML = '<option value="" selected disabled>Select your primary technical skill</option>';

    if (mainField && domainSelect && skillsSelect &&
        mainField.value && domainSelect.value &&
        domainOptions[mainField.value] &&
        domainOptions[mainField.value][domainSelect.value]) {

        const skills = domainOptions[mainField.value][domainSelect.value];
        skills.forEach(function (skill) {
            const option = document.createElement("option");
            option.value = skill;
            option.textContent = skill;
            skillsSelect.appendChild(option);
        });
    }
}