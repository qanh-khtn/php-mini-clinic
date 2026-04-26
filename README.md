# PHP Mini Clinic Appointment

Mini project for practicing HTTP methods GET, POST, HEAD, and OPTIONS with PHP.

## Run

1. Install dependencies:

```bash
composer install
composer dump-autoload
```

2. Create environment file (if needed):

```bash
copy .env.example .env
```

3. Start server:

```bash
php -S localhost:8000 -t public
```

4. Open app:

- Home page: http://localhost:8000/
- API base: http://localhost:8000/

## Endpoints

- GET / -> home page
- GET /appointments -> appointment list JSON
- HEAD /appointments -> headers only
- POST /registrations -> create registration (JSON)
- OPTIONS /registrations -> allowed methods
- GET /health -> health check

## Main Improvements (Bonus)

- Upgraded home page UI with card layout and responsive design.
- Moved styles to separate file: public/assets/home.css.
- Added clear status badge styles for Open / Full.
- Fixed type validation in registration flow so invalid types return 422 instead of 500.

## Test Results After Improvements

| Method | Path | Expected | Actual |
|---|---|---|---|
| GET | / | 200 | 200 |
| GET | /appointments | 200 | 200 |
| HEAD | /appointments | 200 | 200 |
| PUT | /appointments | 405 | 405 |
| POST | /registrations (valid JSON) | 201 | 201 |
| POST | /registrations (text/plain) | 415 | 415 |
| POST | /registrations (missing patient_name) | 422 | 422 |
| POST | /registrations (invalid type) | 422 | 422 |
| POST | /registrations (appointment_id not found) | 422 | 422 |
| POST | /registrations (quantity over limit) | 422 | 422 |
| OPTIONS | /registrations | 204 | 204 |
| GET | /health | 200 | 200 |
| GET | /unknown | 404 | 404 |

## Sample Valid POST Body

```json
{
  "appointment_id": 1,
  "patient_name": "Test User",
  "email": "test@example.com",
  "quantity": 1
}
```
