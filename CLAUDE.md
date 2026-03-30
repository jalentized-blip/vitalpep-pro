# VitalPep Pro — Claude Working Instructions

## Git Workflow (ALWAYS follow this)

- **Never commit directly to `master`**
- All work happens on a `session/YYYY-MM-DD` branch created by `start-session.bat`
- At the end of the session `finish-session.bat` commits, pushes, and opens a PR
- CodeRabbit automatically reviews every PR — wait for its feedback before merging

## When making changes

1. Edit files in `C:/NetherlandsSite/wp-content/themes/vitalpep-pro/`
2. After all edits are done, rebuild the ZIP:
   ```
   python C:/NetherlandsSite/build_zip.py
   ```
3. Do NOT manually run `git add` / `git commit` — `finish-session.bat` handles that

## Project structure

```
vitalpep-pro/
├── functions.php          — CPT registration, meta boxes, seeder, AJAX handlers
├── front-page.php         — Homepage (hero carousel, showcase reel, dosing section)
├── page-flexpens.php      — FlexPens catalog (100% CPT-driven loop)
├── page-calculator.php    — Dosage calculator (products from CPT JSON)
├── inc/customizer.php     — Customizer settings and defaults
└── assets/
    ├── images/            — Theme images (pen photos, logos)
    ├── pdfs/              — Dosage manual PDFs
    └── js/main.js         — Frontend JavaScript
```

## Key CPT: `vp_flexpen`

Each FlexPen post drives everything. Key meta fields:

| Field | Purpose |
|---|---|
| `_vpp_fp_img_carousel` | Hero carousel photo |
| `_vpp_fp_img_showcase` | Showcase reel photo |
| `_vpp_fp_img_catalog`  | FlexPens page photo |
| `_vpp_fp_show_in_reel` | Show in homepage showcase (checkbox) |
| `_vpp_fp_show_in_calc` | Show in dosage calculator (checkbox) |
| `_vpp_fp_show_in_dosing` | Show in dosing PDF section (checkbox) |
| `_vpp_fp_pdf`          | Dosage manual PDF URL |
| `_vpp_fp_calc_mg/ml/maxdose/unit/freq` | Calculator fields |

## PDF generation

- Manual PDFs: `C:/NetherlandsSite/gen_manuals.py`
- Auto-PDF from post data: `C:/NetherlandsSite/gen_auto_manual.py`

## CodeRabbit

Configured via `.coderabbit.yaml`. Runs automatically on every PR.
Reviews focus on: output escaping, nonce verification, capability checks, WP best practices.
