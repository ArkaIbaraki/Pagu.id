# Security Policy

## Reporting a Vulnerability

Jika Anda menemukan security vulnerability, **JANGAN** laporkan di public issue.

**Email:** security@arkas.my.id

Sertakan:
- Deskripsi vulnerability
- Steps untuk reproduce
- Potential impact
- Suggested fix (jika ada)

Kami akan:
- Confirm receipt dalam 24 jam
- Provide timeline untuk fix
- Notify Anda saat fix dirilis

## Supported Versions

| Version | Supported | End of Life |
|---------|-----------|-------------|
| 1.0.x   | ✅ Yes    | 2026-03-24 |
| < 1.0   | ❌ No     | N/A |

## Security Best Practices

### For Users

1. **Keep Data Safe**
   - Data disimpan lokal di browser Anda
   - Jangan bagikan file PDF ke orang yang tidak dipercaya
   - Gunakan HTTPS saat upload ke server

2. **Browser Security**
   - Gunakan browser terbaru
   - Aktifkan auto-update
   - Disable unnecessary extensions

3. **Data Backup**
   - Export PDF secara regular
   - Jangan andalkan hanya history (max 10)

### For Developers

1. **Code Review**
   - Review code sebelum merge
   - Test security implications
   - Check dependencies

2. **Dependency Management**
   ```bash
   npm audit
   npm audit fix
   npm outdated
   ```
3. **TypeScript Strict Mode**
   - Enable strict type checking
   - Use strict null checks
   - Validate user input

4. **Content Security**
   - No eval() usage
   - Sanitize user inputs
   - Validate file uploads

## Known Vulnerabilities
Tidak ada known vulnerabilities saat ini.

## Security Headers
Aplikasi mengimplementasikan:
```
Content-Security-Policy: default-src 'self'
X-Content-Type-Options: nosniff
X-Frame-Options: DENY
X-XSS-Protection: 1; mode=block
Referrer-Policy: strict-origin-when-cross-origin
```

## Privacy
- ✅ Client-side only - No data sent to server
- ✅ No cookies - Except essential localStorage
- ✅ No tracking - No analytics code
- ✅ No 3rd party - No external service calls
- ✅ GDPR compliant - User data fully controlled

## SSL/TLS
Semua komunikasi (jika ada):
- HTTPS only
- TLS 1.2+
- Valid certificates


## Changelog
#### Security Releases
Security patches dirilis dengan priority tinggi:

- Development: ASAP
- Testing: 24 hours
- Production: 48 hours

---

**Last Updated**: 2026-03-24

