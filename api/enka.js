export default async function handler(req, res) {
  const { uid } = req.query;

  if (!uid || !/^\d{6,10}$/.test(uid)) {
    return res.status(400).json({
      error: "Invalid UID",
      message: "UID harus berupa 6–10 digit angka."
    });
  }

  try {
    const response = await fetch(
      `https://enka.network/api/uid/${encodeURIComponent(uid)}/?info`,
      {
        headers: {
          "User-Agent": "Kokobear-Status-Joki/1.0"
        }
      }
    );

    const body = await response.text();

    res.setHeader("Access-Control-Allow-Origin", "*");
    res.setHeader("Cache-Control", "s-maxage=60, stale-while-revalidate=300");

    if (!response.ok) {
      return res.status(response.status).send(body);
    }

    res.setHeader("Content-Type", "application/json; charset=utf-8");
    return res.status(200).send(body);

  } catch (error) {
    return res.status(502).json({
      error: "Enka request failed",
      message: error?.message || "Unknown error"
    });
  }
}
