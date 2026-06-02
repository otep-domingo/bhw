# BHW Monthly Accomplishment Report System
## Setup Guide (XAMPP + Node.js)

---

## FOLDER STRUCTURE

```
bhw-app/
├── bhw_database.sql          ← Run this in phpMyAdmin first
├── frontend/
│   └── index.html            ← The web app (served by Express)
└── backend/
    ├── server.js             ← Main entry point
    ├── package.json
    ├── .env.example          ← Copy to .env and configure
    ├── config/
    │   └── db.js             ← MySQL connection pool
    ├── middleware/
    │   └── auth.js           ← JWT verification
    └── routes/
        ├── auth.js           ← /api/auth/register, /login, /me
        └── reports.js        ← /api/reports CRUD
```

---

## STEP 1 — Start XAMPP

1. Open **XAMPP Control Panel**
2. Start **Apache** and **MySQL**
3. Open **phpMyAdmin** → http://localhost/phpmyadmin

---

## STEP 2 — Create the Database

1. In phpMyAdmin, click **"New"** (left sidebar)
2. Or click the **SQL tab** at the top
3. Paste the entire contents of `bhw_database.sql`
4. Click **Go** to run it
5. You should see `bhw_report_db` appear in the left sidebar

---

## STEP 3 — Configure Environment

1. Go into the `backend/` folder
2. **Copy** `.env.example` → rename it to `.env`
3. Open `.env` and set your values:

```env
DB_HOST=localhost
DB_PORT=3306
DB_USER=root
DB_PASSWORD=          ← Leave blank if XAMPP default (no password)
DB_NAME=bhw_report_db

JWT_SECRET=change_this_to_a_long_random_string
JWT_EXPIRES_IN=8h

PORT=3000
```

> ⚠️ If you set a MySQL root password in XAMPP, enter it in DB_PASSWORD.

---

## STEP 4 — Install Node.js Dependencies

Open a terminal (Command Prompt or PowerShell) inside the `backend/` folder:

```bash
cd backend
npm install
```

This installs: express, mysql2, bcryptjs, jsonwebtoken, cors, dotenv

---

## STEP 5 — Start the Server

Still inside the `backend/` folder:

```bash
# Production
node server.js

# Development (auto-restart on file changes)
npm run dev
```

You should see:
```
✅ MySQL connected successfully
🚀 BHW Report Server running at http://localhost:3000
```

---

## STEP 6 — Open the App

Open your browser and go to:
```
http://localhost:3000
```

The login screen will appear. Click **Register** to create your first account.

---

## HOW MULTI-USER WORKS

| Feature | Behavior |
|---|---|
| Login | Each BHW has their own username + password |
| Own reports | Full create / edit / delete access |
| Same barangay reports | **View only** — cannot edit other BHWs' data |
| Different barangay | Cannot see those reports at all |
| Session | JWT token, valid for 8 hours |

---

## API ENDPOINTS REFERENCE

| Method | Endpoint | Description |
|---|---|---|
| POST | /api/auth/register | Create new BHW account |
| POST | /api/auth/login | Login, returns JWT token |
| GET | /api/auth/me | Get current user info |
| GET | /api/reports | List own + same-barangay reports |
| GET | /api/reports/:id | Get single report with all data |
| POST | /api/reports | Create new report |
| PUT | /api/reports/:id | Update report (own only) |
| DELETE | /api/reports/:id | Delete report (own only) |
| GET | /api/health | Server health check |

---

## TROUBLESHOOTING

**"MySQL connection failed"**
- Make sure XAMPP MySQL is running
- Check DB_PASSWORD in .env matches your XAMPP MySQL password
- Default XAMPP has no password (leave DB_PASSWORD blank)

**"Cannot GET /"**
- Make sure you ran `npm install` inside the `backend/` folder
- Make sure `frontend/index.html` exists

**Port 3000 already in use**
- Change `PORT=3001` in `.env` and update `API_BASE` in `frontend/index.html` to match

**"Failed to fetch" in browser**
- Confirm the backend server is running
- Check that `API_BASE` in `frontend/index.html` matches your server port
