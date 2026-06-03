# TERESCO Web Application Overview & Architecture Guide

Welcome to the **St. Theresa's College of Education (TERESCO)** web application documentation. This guide is compiled to provide an in-depth understanding of the system's business domains, architectural structure, and feature layouts, enabling any developer or AI agent to quickly start working in the codebase.

---

## Technical Stack & Architecture

The application is built on a modern, high-performance PHP/Laravel ecosystem:
- **Core Framework**: Laravel 13 running on PHP 8.4.
- **Frontend / UI Layer**: Livewire v4 and Livewire Volt v1 (functional/single-file Blade components).
- **Styling**: Tailwind CSS v4.
- **Admin Panel & Dashboards**: Filament v5.
- **Testing Suite**: Pest PHP v3.

### Key Architectural Patterns
1. **Single-File Page Components**: Main frontend pages are implemented as Volt functional components located in `resources/views/pages/` and prefixed with a thunderbolt symbol (e.g., `⚡home.blade.php`).
2. **Page Controllers**: The `LivewirePageController` dynamically binds Volt components to web endpoints defined in `routes/web.php`.
3. **Global Data Sharing**: An Eloquent view composer in `AppServiceProvider.php` shares the global college settings (`Institution`) and lists of departments with all views automatically.

---

## Feature-Grouped Codebase Breakdown

Below is the logical mapping of files according to their business features and functional domains.

### 1. Admissions & Student Applications
- **Database Models**: `App\Models\Application`
- **Frontend Pages**: 
  - `⚡admissions.blade.php` (The main prospective student application form)
  - `⚡admission-complete.blade.php` (A post-submission summary page)
- **Admin Panel Resource**: `App\Filament\Resources\ApplicationResource`
- **Seeders**: `Database\Seeders\ApplicationSeeder`

**Feature Walkthrough**:
Prospective students access the application form to submit contact details, select their desired course, intake term, enter their school grades/index number, and upload supporting documents (certificates). Applications are saved in the `applications` database table and marked as pending review. Administrators can review, download files, and approve/reject applications within the Filament panel.

---

### 2. News, Announcements & Updates
- **Database Models**: `App\Models\NewsItem`, `App\Models\NewsCategory`
- **Frontend Pages**: 
  - `⚡news.blade.php` (Main news directory with filters and search)
- **Admin Panel Resource**: `App\Filament\Resources\NewsItemResource`, `App\Filament\Resources\NewsCategoryResource`
- **Seeders**: `Database\Seeders\NewsSeeder`

**Feature Walkthrough**:
Displays official college updates, events, achievements, and announcements. The frontend features the latest news item at the top. Users can filter items by categories (dynamically populated from the database) or use the text search bar (queries the title, excerpt, and content fields). All components are fully managed via Filament.

---

### 3. Alumni Success Stories
- **Database Models**: `App\Models\SuccessStory`
- **Frontend Pages**:
  - `⚡success-stories.blade.php` (Grid display of approved success stories)
  - `⚡success-stories-create.blade.php` (Form to submit a success story)
- **Admin Panel Resource**: `App\Filament\Resources\SuccessStoryResource`
- **Seeders**: `Database\Seeders\SuccessStorySeeder`

**Feature Walkthrough**:
Alumni submit a form sharing their achievements (name, department, course, graduation year, current occupation, employer/company, rating from 1 to 5 stars, message, and a profile photo). Submissions are saved as unapproved (`is_approved = false`). Once an admin approves the record via the Filament panel, it renders dynamically in the public grid view.

---

### 4. Academic & Non-Academic Departments
- **Database Models**: `App\Models\Department`, `App\Models\Course`
- **Frontend Pages**:
  - `⚡departments.blade.php` (Grid lists of all departments)
  - `⚡department.blade.php` (Academic department detail page showing courses)
  - `⚡service-department.blade.php` (Non-academic department detail page)
  - `⚡courses.blade.php` (Complete course directory listing)
- **Admin Panel Resource**: `App\Filament\Resources\DepartmentResource`, `App\Filament\Resources\CourseResource`
- **Seeders**: `Database\Seeders\DepartmentSeeder`, `Database\Seeders\CourseSeeder`

**Feature Walkthrough**:
Dynamically manages college sections. Academic departments (e.g., Cosmetology, Hospitality, ICT) and Non-Academic departments (e.g., Finance, Student Affairs, Library) are defined. Frontend pages list their assignments, related courses, and staff assigned to the department. Detail views are matched via slugs.

---

### 5. College Management & Team Structures
- **Database Models**: `App\Models\TeamMember`, `App\Models\Role`
- **Frontend Pages**:
  - `⚡principal-office.blade.php` (Principal's message board and timeline achievements)
  - `⚡deputy-principal-administration.blade.php` (Deputy Principal - Administration office)
  - `⚡deputy-principal-academics.blade.php` (Deputy Principal - Academics office)
  - `⚡staff-members.blade.php` / `⚡team-members.blade.php` (Full staff directory)
- **Admin Panel Resource**: `App\Filament\Resources\TeamMemberResource`, `App\Filament\Resources\RoleResource`
- **Seeders**: `Database\Seeders\TeamMemberSeeder`, `Database\Seeders\RoleSeeder`

**Feature Walkthrough**:
Organizes college hierarchy. Roles specify ranks (Principal, Deputy Principal, HOD, Trainer). The offices render individual messages, bios, photos, and contact information. HOD assignments dynamically link back to their respective academic or service departments.

---

### 6. Procurement, Vacancies & Documents
- **Database Models**: `App\Models\Tender`, `App\Models\Vacancy`, `App\Models\Download`, `App\Models\PastPaper`
- **Frontend Pages**:
  - `⚡tenders.blade.php` (Active tender bids and PDF links)
  - `⚡vacancies.blade.php` (Job vacancy descriptions and apply details)
  - `⚡downloads.blade.php` (General files, forms, and newsletters download center)
  - `⚡past-papers.blade.php` (Filterable directory of revision materials)
- **Admin Panel Resource**: `App\Filament\Resources\TenderResource`, `App\Filament\Resources\VacancyResource`, `App\Filament\Resources\DownloadResource`, `App\Filament\Resources\PastPaperResource`
- **Seeders**: `Database\Seeders\TenderSeeder`, `Database\Seeders\VacancySeeder`, `Database\Seeders\DownloadSeeder`

**Feature Walkthrough**:
Provides administration-backed public utilities. Tenders, vacancies, circulars, and past revision papers are stored with links to local files. The past papers page provides search and dropdown sorting by courses/departments.

---

### 7. Page Visits Analytics System
- **Database Models**: `App\Models\PageVisit`
- **Middleware**: `App\Http\Middleware\TrackPageVisits`
- **Migration**: `page_visits` table

**Feature Walkthrough**:
Runs globally on GET HTTP requests. The middleware filters out non-content requests (admin dashboards, API endpoints, AJAX updates, authentication views, Livewire-internal routes like `livewire/*`, and static asset formats like `.js`, `.css`, `.png`). It anonymizes client IP addresses using a SHA-256 hash and records the path, referer, user agent, and timestamp for college analytics reports.

---

## Technical Settings & Database Verification

To fresh install or reset the local environment:
1. Run migrations and seed data:
   ```bash
   php artisan migrate:fresh --seed
   ```
2. Build frontend assets:
   ```bash
   npm run build
   ```
3. Run the automated test suite:
   ```bash
   php artisan test --compact
   ```
