# Refactoring Documentation - Visibility & Configuration Management

## Problem Analysis & Solutions Implemented

### 1. Visibility (Encapsulation) Issue
**Problem**: Fatal error when accessing protected getter methods from global scope (index.php)
```php
// ❌ Before: Protected methods - FATAL ERROR
protected function getIdTiket(): int { ... }

// Error: Call to protected method Tiket::getIdTiket() from global scope
$id = $tiket->getIdTiket();
```

**Solution**: Convert getter methods to `public` while maintaining encapsulation
```php
// ✅ After: Public methods - WORKS
public function getIdTiket(): int { ... }

// Properties remain protected (internal state protected)
protected int $id_tiket;

// Now accessible from Presentation Layer
$id = $tiket->getIdTiket();
```

**Why This Works:**
- **Encapsulation preserved**: Properties (`$id_tiket`) still protected → cannot be directly modified
- **Controlled access**: Public getters provide read-only interface
- **Separation of Concerns**: Business logic (Model) can be consumed by Presentation Layer (View)

---

### 2. Database Configuration Management
**Problem**: Hardcoded database credentials
```php
// ❌ Before: Hardcoded - Security risk, not maintainable
private string $dbName = 'db_latihan_pbo_trpl1b_giant_pandu_titisan_budiansyah';
```

**Solution**: Centralized configuration system + environment variables
```php
// ✅ After: Config-driven - Flexible, secure, maintainable
$config = require __DIR__ . '/config.php';
$db = new Database($config['database']);
```

**Files Created:**

1. **config.php** - Centralized configuration
   - Reads from environment variables (`$_ENV`)
   - Provides sensible defaults
   - Separates config from code

2. **.env.example** - Environment template
   - Documents all available environment variables
   - Safe to commit (no credentials)
   - Users copy to `.env` locally

3. **.gitignore** - Prevents credential leaks
   - Blocks `.env` file from version control
   - Prevents accidental credential exposure

---

## Architecture Pattern: Configuration-Driven Design

### Before (Tightly Coupled)
```
index.php
├── Hardcoded DB name
├── Direct instantiation with string parameter
└── Difficult to switch environments
```

### After (Loosely Coupled)
```
index.php
├── config.php (loads environment variables)
├── Database class (receives config array)
└── Easy environment switching
```

---

## Usage Instructions

### Local Development Setup

1. **Create .env file** from template:
   ```bash
   cp .env.example .env
   ```

2. **Edit .env** with your credentials:
   ```env
   DB_HOST=localhost
   DB_USER=root
   DB_PASS=
   DB_NAME=db_latihan_pbo_trpl1b_giant_pandu_titisan_budiansyah
   ```

3. **Verify configuration** is loaded:
   ```php
   $config = require 'config.php';
   echo $config['database']['name']; // Should output your database name
   ```

### Production Deployment

- Set environment variables on server (no .env file)
- config.php automatically reads from `$_ENV`
- No credentials in repository

---

## Key Design Principles Applied

| Principle | Implementation |
|-----------|-----------------|
| **Encapsulation** | Private properties, public getters |
| **Separation of Concerns** | Config separate from code |
| **DRY (Don't Repeat Yourself)** | Single source of truth for DB credentials |
| **Security** | Environment variables, no hardcoding |
| **Maintainability** | Easy to update configuration |
| **Testability** | Config can be easily mocked for tests |

---

## Files Modified

1. **Tiket.php**
   - Changed: `protected function getIdTiket()` → `public function getIdTiket()`
   - Changed: `protected function getNamaFilm()` → `public function getNamaFilm()`
   - Changed: `protected function getJadwalTayang()` → `public function getJadwalTayang()`
   - Changed: `protected function getJumlahKursi()` → `public function getJumlahKursi()`
   - Changed: `protected function getHargaDasarTiket()` → `public function getHargaDasarTiket()`

2. **koneksi/database.php**
   - Changed: Constructor to accept config array instead of string parameter
   - Changed: Properties to be initialized from config

3. **index.php**
   - Added: `$config = require 'config.php'`
   - Changed: `new Database($config['database'])` instead of hardcoded string

## Files Created

1. **config.php** - Centralized configuration
2. **.env.example** - Environment template
3. **.gitignore** - Prevent credential leaks

---

## Next Steps (Optional Enhancements)

1. **Load .env file at runtime** (require external library like vlucas/phpdotenv)
2. **Database connection pooling** for performance
3. **Configuration validation** to ensure required fields exist
4. **Logging configuration** for production debugging
5. **Multiple environment support** (dev, staging, production)
