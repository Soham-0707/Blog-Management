# Render Deployment Guide for Blog Management

This guide explains how to deploy the Blog Management application to Render.com with MySQL database.

## Prerequisites

- GitHub account with this repository connected
- Render.com account
- The repository contains `render.yaml` for automated Render configuration

## Step-by-Step Deployment

### 1. Connect Your Repository to Render

1. Go to [Render Dashboard](https://dashboard.render.com/)
2. Click **New +** → **Web Service**
3. Select **GitHub** and authenticate
4. Search and select `Soham-0707/Blog-Management` repository
5. Click **Connect**

### 2. Configure the Web Service

Render will automatically detect the `render.yaml` file. You'll see:
- **Name**: `blog-management` (auto-filled)
- **Plan**: Standard (1GB RAM, $7/month)
- **Auto-deploy**: Enabled by default

**Click Deploy**

### 3. CRITICAL: Set Environment Variables FIRST

⚠️ **This is the most common cause of 500 errors!**

#### Generate APP_KEY Locally (REQUIRED)

Run this on your local machine:
```bash
php artisan key:generate --show
```

Copy the output (starts with `base64:`)

#### Add Environment Variables to Render

1. **WAIT for deployment to show in Dashboard** (5-10 minutes)
2. Go to your service page → **Settings** → **Environment**
3. **Add these variables EXACTLY as shown:**

```
APP_KEY = [PASTE THE KEY FROM ABOVE - STARTS WITH base64:]
APP_NAME = Blog Management
APP_ENV = production
APP_DEBUG = false
APP_URL = https://blog-management-X-XXXu.onrender.com [YOUR ACTUAL DOMAIN]
DB_CONNECTION = mysql
DB_PORT = 3306
DB_DATABASE = blog_management
```

⚠️ **Do NOT include any extra spaces or quotes**

### 4. Wait for MySQL Database Service

The `render.yaml` automatically creates a `blog-db` MySQL service.

1. Go back to Dashboard
2. You should see TWO services:
   - `blog-management` (web)
   - `blog-db` (MySQL database)

3. **Wait until `blog-db` shows "Live" status** (takes 2-3 minutes)
4. Click on `blog-db` service
5. Copy these from "Connection Details":
   - `DB_HOST` (Internal or External)
   - `DB_USERNAME`
   - `DB_PASSWORD`

### 5. Add Database Environment Variables

Go back to `blog-management` service → **Settings** → **Environment**

Add:
```
DB_HOST = [from blog-db service connection details]
DB_USERNAME = [from blog-db service connection details]
DB_PASSWORD = [from blog-db service connection details]
```

### 6. Manually Deploy to Apply Variables

1. Go to your web service page
2. Click **Manual Deploy** button (top right)
3. Wait for deployment to complete (watch Logs tab)

### 7. Verify Deployment

1. Check **Logs** tab for errors
2. Once deployment shows "Live", visit your app URL
3. Test:
   - Homepage loads without error
   - Blog listing displays
   - AJAX filtering works
   - Admin login works

## 🔴 Troubleshooting 500 Error

### Quick Checklist

- [ ] `APP_KEY` is set (check Settings → Environment)
- [ ] `APP_KEY` starts with `base64:`
- [ ] All `DB_*` variables are filled in
- [ ] `blog-db` service shows **Live** status
- [ ] **Manual Deploy** clicked AFTER adding all variables

### Common Issues & Fixes

| Issue | Solution |
|-------|----------|
| **500 error after deploy** | Missing `APP_KEY`. Run `php artisan key:generate --show` locally and add to Render |
| **Database connection error** | Check `DB_HOST`, `DB_USERNAME`, `DB_PASSWORD` match `blog-db` service. Wait 2-3 min for MySQL to init |
| **"SQLSTATE" errors in logs** | Run **Manual Deploy** again - migrations may have failed first time |
| **APP still shows old code** | Clear cache: **Manual Deploy** in Render (don't just refresh browser) |
| **File upload not working** | Render has ephemeral storage - files deleted on redeploy. Configure S3 for persistent uploads |

### Enable Debug Mode (Temporarily)

1. **Settings** → **Environment**
2. Change `APP_DEBUG` to `true`
3. Click **Manual Deploy**
4. Visit website - see actual error
5. Share error message with support
6. Change `APP_DEBUG` back to `false` after debugging

### View Detailed Logs

1. Go to service → **Logs** tab
2. Look for error messages with "Illuminate", "PDOException", or "SQLSTATE"
3. Most recent errors appear at bottom

### SSH Into Container (Advanced)

1. Click **Connect** button on service page
2. Choose **SSH** option
3. Run: `cat storage/logs/laravel.log | tail -50`
4. Look for error patterns

## Environment Variables Reference

| Variable | Example | Notes |
|----------|---------|-------|
| `APP_NAME` | `Blog Management` | Display name |
| `APP_ENV` | `production` | MUST be "production" |
| `APP_DEBUG` | `false` | Set to `true` only for debugging |
| `APP_KEY` | `base64:xxxxx` | Generate with `php artisan key:generate --show` |
| `APP_URL` | `https://your-domain.onrender.com` | Your Render domain |
| `DB_CONNECTION` | `mysql` | Database type |
| `DB_HOST` | `mysql-xxx.c.render.com` | From blog-db service |
| `DB_PORT` | `3306` | MySQL port |
| `DB_DATABASE` | `blog_management` | Database name |
| `DB_USERNAME` | `render_user` | From blog-db service |
| `DB_PASSWORD` | `xxxxx` | From blog-db service |

## First Deploy Checklist

- [ ] Repository pushed to GitHub
- [ ] Connected to Render (service shows "Live")
- [ ] `blog-db` service shows "Live"
- [ ] All required environment variables set
- [ ] Manual Deploy clicked
- [ ] Website loads without error
- [ ] Homepage blog listing works
- [ ] Admin login accessible at `/admin`

## Continuous Deployment

Push to `main` branch → Render auto-redeploys → Website updates automatically

## Monitoring

- **Metrics**: Dashboard shows CPU, memory, requests
- **Logs**: Real-time logs in Logs tab
- **Alerts**: Set in Account Settings for downtime

## Rollback

If deployment breaks production:

1. Go to **Deployments** tab
2. Find last working deployment
3. Click three dots → **Redeploy**

## Support

If you still see 500 error:

1. Check **Logs** tab for specific error
2. Verify all environment variables (especially `APP_KEY`)
3. Run **Manual Deploy** after adding/fixing variables
4. Share the error message from logs

---

**Deployed!** Your Blog Management System is now live on Render 🎉

