// config/db.js
// MySQL connection pool using mysql2
// Uses environment variables from .env

const mysql = require('mysql2/promise');
require('dotenv').config();

const pool = mysql.createPool({
  host:               process.env.DB_HOST     || 'localhost',
  port:               parseInt(process.env.DB_PORT) || 3306,
  user:               process.env.DB_USER     || 'root',
  password:           process.env.DB_PASSWORD || '',
  database:           process.env.DB_NAME     || 'bhw_report_db',
  waitForConnections: true,
  connectionLimit:    10,       // max concurrent connections
  queueLimit:         0,
  charset:            'utf8mb4'
});

// Test connection on startup
pool.getConnection()
  .then(conn => {
    console.log('✅ MySQL connected successfully');
    conn.release();
  })
  .catch(err => {
    console.error('❌ MySQL connection failed:', err.message);
    process.exit(1); // Exit if DB is unreachable
  });

module.exports = pool;
