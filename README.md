# Kokobear — Status Joki Live

## Struktur

- `index.html` — frontend
- `api/enka.js` — proxy server-side ke Enka Network
- `vercel.json` — konfigurasi Vercel

## Deploy

Upload/push seluruh isi folder ini ke repository GitHub, lalu connect repository tersebut ke Vercel.

Setelah deploy, tes:

`https://DOMAIN-VERCEL-KAMU.vercel.app/api/enka?uid=812213263`

Jika API aktif, endpoint tersebut akan meneruskan response dari Enka Network.

## Catatan

Frontend tidak lagi memanggil Enka Network secara langsung, sehingga masalah CORS browser dihindari.
