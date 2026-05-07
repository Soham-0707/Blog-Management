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

### 3. Set Required Environment Variables

After deployment is triggered, go to **Settings** → **Environment**:

**Critical Variables (add these manually):**

```
APP_KEY = <generate from local: php artisan key:generate --show>
APP_NAME = Blog Management
APP_ENV = production
APP_DEBUG = false
APP_URL = https://your-app-name.onrender.com
LOG_CHANNEL = stderr
```

Replace `your-app-name` with your actual Render domain (visible at top of service page).

### 4. MySQL Database Connection

The `render.yaml` automatically provisions a MySQL database. Once created:

1. Go back to Render Dashboard
2. You'll see two services: `blog-management` (web) and `blog-db` (MySQL)
3. Click on `blog-db` and note the connection details:
   - **Host**: Copy from "Internal Database URL" or "External Database URL"
   - **Username**: Default is `render`
   - **Password**: Auto-generated (visible in Internal Database URL)
   - **Database**: `blog_management`

4. Update web service environment variables:
   - `DB_HOST` = [MySQL host from above]
   - `DB_USERNAME` = `render`
   - `DB_PASSWORD` = [Password from above]
   - `DB_DATABASE` = `blog_management`

### 5. Generate APP_KEY Locally

Run this on your local machine:
```bash
php artisan key:generate --show
```

Copy the output (base64:...) and paste it into Render's `APP_KEY` environment variable.

### 6. Verify Deployment

1. Check **Logs** tab in Render Dashboard for build/run output
2. Once deployment succeeds, visit your app URL: `https://your-app-name.onrender.com`
3. Test the following:
   - **Home page** loads without errors
   - **Blog listing** displays blogs from database
   - **AJAX filtering** works (search, category, date filters)
   - **Admin login** accessible at `/admin`
   - **Admin CRUD** (create, edit, delete blogs)
   - **Image uploads** save and display correctly

### 7. Troubleshooting

**Build Fails:**
- Check Logs tab for specific error
- Ensure `composer.lock` is valid (exists and up-to-date)
- Verify `npm` dependencies are correct

**Database Connection Error:**
- Confirm `DB_HOST`, `DB_USERNAME`, `DB_PASSWORD` match MySQL service
- Check that MySQL service is running (green checkmark in Render Dashboard)
- Wait 2-3 minutes after MySQL creation before first connection

**App Crashes After Deploy:**
- Check Logs for PHP errors
- Verify all env variables are set (especially `APP_KEY`, `DB_*`)
- Ensure migrations completed successfully

**Image Uploads Not Working:**
- Render provides ephemeral storage (files deleted on redeploy)
- For persistent uploads, integrate AWS S3 or Render's database storage

## Environment Variables Summary

| Variable | Production Value | Notes |
|----------|-----------------|-------|
| APP_ENV | production | Set for security |
| APP_DEBUG | false | Hide errors from users |
| LOG_CHANNEL | stderr | Render captures stderr to logs |
| DB_CONNECTION | mysql | Don't use sqlite for production |
| SESSION_DRIVER | cookie | Works without server state |
| QUEUE_CONNECTION | sync | Processes jobs immediately (no Redis) |
| CACHE_STORE | array | In-memory cache, resets on redeploy |

## Continuous Deployment

Once connected, Render automatically redeploys when you:
1. Push to the `main` branch on GitHub
2. New deployment runs build command and migrations
3. Deployment fails if build or migrations fail (rollback to previous version)

## Monitoring

- **Metrics**: View CPU, memory, requests per Render Dashboard
- **Logs**: Real-time logs in **Logs** tab
- **Alerts**: Enable in Account Settings for downtime/errors
- **Support**: Submit support tickets for infrastructure issues

## Scaling

To handle more traffic:
1. Go to **Settings** → **Plan**
2. Upgrade to higher tier (Starter → Standard → Premium)
3. Enable horizontal scaling if available

## Database Backups

1. Go to `blog-db` service
2. Click **Backups** tab
3. Backups are automatic (check Render pricing for retention)
4. For manual backup: Export via MySQL client

## Redeploy Without Code Changes

1. Go to **Deployments** tab
2. Click three dots on any deployment
3. Select **Redeploy**
4. Useful for triggering migrations or clearing cache

---

**First deployment complete!** Your Blog Management System is now live on Render. 🎉
