// routes/auth.js
// POST /api/auth/register  - create a new BHW account
// POST /api/auth/login     - login and receive JWT token
// GET  /api/auth/me        - get current user info (protected)

const express  = require('express');
const bcrypt   = require('bcryptjs');
const jwt      = require('jsonwebtoken');
const db       = require('../config/db');
const auth     = require('../middleware/auth');
require('dotenv').config();

const router = express.Router();

/* -------------------------------------------------------
   POST /api/auth/register
   Body: { username, password, full_name, barangay, area }
   Creates a new BHW user account
------------------------------------------------------- */
router.post('/register', async (req, res) => {
  const { username, password, full_name, barangay, area } = req.body;

  // Basic validation
  if (!username || !password || !full_name || !barangay || !area) {
    return res.status(400).json({ error: 'All fields are required.' });
  }
  if (password.length < 6) {
    return res.status(400).json({ error: 'Password must be at least 6 characters.' });
  }

  try {
    // Check if username already exists
    const [existing] = await db.query(
      'SELECT id FROM users WHERE username = ?', [username]
    );
    if (existing.length > 0) {
      return res.status(409).json({ error: 'Username already taken.' });
    }

    // Hash password with bcrypt (cost factor 12)
    const password_hash = await bcrypt.hash(password, 12);

    // Insert new user
    const [result] = await db.query(
      `INSERT INTO users (username, password_hash, full_name, barangay, area, role)
       VALUES (?, ?, ?, ?, ?, 'bhw')`,
      [username.trim(), password_hash, full_name.trim(), barangay.trim(), area.trim()]
    );

    res.status(201).json({
      message: 'Account created successfully.',
      user_id: result.insertId
    });

  } catch (err) {
    console.error('Register error:', err);
    res.status(500).json({ error: 'Server error during registration.' });
  }
});

/* -------------------------------------------------------
   POST /api/auth/login
   Body: { username, password }
   Returns: { token, user }
------------------------------------------------------- */
router.post('/login', async (req, res) => {
  const { username, password } = req.body;

  if (!username || !password) {
    return res.status(400).json({ error: 'Username and password are required.' });
  }

  try {
    // Fetch user by username
    const [rows] = await db.query(
      'SELECT id, username, password_hash, full_name, barangay, area, role FROM users WHERE username = ?',
      [username.trim()]
    );

    if (rows.length === 0) {
      return res.status(401).json({ error: 'Invalid username or password.' });
    }

    const user = rows[0];

    // Compare password
    const isMatch = await bcrypt.compare(password, user.password_hash);
    if (!isMatch) {
      return res.status(401).json({ error: 'Invalid username or password.' });
    }

    // Sign JWT
    const token = jwt.sign(
      {
        id:       user.id,
        username: user.username,
        barangay: user.barangay,
        area:     user.area,
        role:     user.role
      },
      process.env.JWT_SECRET,
      { expiresIn: process.env.JWT_EXPIRES_IN || '8h' }
    );

    res.json({
      token,
      user: {
        id:        user.id,
        username:  user.username,
        full_name: user.full_name,
        barangay:  user.barangay,
        area:      user.area,
        role:      user.role
      }
    });

  } catch (err) {
    console.error('Login error:', err);
    res.status(500).json({ error: 'Server error during login.' });
  }
});

/* -------------------------------------------------------
   GET /api/auth/me  (protected)
   Returns current logged-in user info
------------------------------------------------------- */
router.get('/me', auth, async (req, res) => {
  try {
    const [rows] = await db.query(
      'SELECT id, username, full_name, barangay, area, role, created_at FROM users WHERE id = ?',
      [req.user.id]
    );
    if (rows.length === 0) return res.status(404).json({ error: 'User not found.' });
    res.json(rows[0]);
  } catch (err) {
    console.error('Me error:', err);
    res.status(500).json({ error: 'Server error.' });
  }
});

module.exports = router;
