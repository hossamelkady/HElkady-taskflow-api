# API examples

Base URL: `http://127.0.0.1:8000/api`

## Create sample record

```http
POST /tasks
Accept: application/json
Content-Type: application/json

{
  "title": "Prepare client proposal",
  "description": "Outline scope and delivery milestones.",
  "status": "in_progress",
  "due_date": "2026-12-10"
}
```

## Validation

Submit an empty object and the API responds with HTTP 422 and field-level validation errors.
