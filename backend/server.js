// server.js
// BHW Monthly Accomplishment Report - Express Backend
// Run: node server.js  OR  npm run dev (with nodemon)

require('dotenv').config();
const express = require('express');
const cors    = require('cors');
const path    = require('path');

const authRoutes    = require('./routes/auth');
const reportRoutes  = require('./routes/reports');

const app  = express();
const PORT = process.env.PORT || 3000;

// ===================== MIDDLEWARE =====================

// CORS - allow frontend to call the API
app.use(cors({
  origin:      process.env.CORS_ORIGIN || '*',
  credentials: true,
  methods:     ['GET','POST','PUT','DELETE','OPTIONS'],
  allowedHeaders: ['Content-Type','Authorization']
}));

// Parse JSON bodies
app.use(express.json({ limit: '5mb' }));
app.use(express.urlencoded({ extended: true }));

// Serve the frontend HTML from the /frontend folder
app.use(express.static(path.join(__dirname, '../frontend')));

// ===================== API ROUTES =====================
app.use('/api/auth',    authRoutes);
app.use('/api/reports', reportRoutes);

// ===================== HEALTH CHECK =====================
app.get('/api/health', (req, res) => {
  res.json({ status: 'ok', timestamp: new Date().toISOString() });
});

// ===================== CATCH-ALL (SPA fallback) =====================
app.get('*', (req, res) => {
  res.sendFile(path.join(__dirname, '../frontend/index.html'));
});

// ===================== GLOBAL ERROR HANDLER =====================
app.use((err, req, res, next) => {
  console.error('Unhandled error:', err);
  res.status(500).json({ error: 'An unexpected server error occurred.' });
});

// ===================== START SERVER =====================
app.listen(PORT, () => {
  console.log(`\n🚀 BHW Report Server running at http://localhost:${PORT}`);
  console.log(`📋 API base: http://localhost:${PORT}/api`);
  console.log(`🌐 Frontend: http://localhost:${PORT}\n`);
});
