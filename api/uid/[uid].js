export default async function handler(req, res) {
  const { uid } = req.query;

  if (!uid || !/^\d{6,10}$/.test(uid)) {
    return res.status(400).json({ error: "Invalid UID" });
  }

  try {
    const response = await fetch(`https://enka.network/api/uid/${uid}/?info`, {
      headers: {
        "User-Agent": "Kokobear-Status-Joki/1.0"
      }
    });

    const text = await response.text();

    res.setHeader("Access-Control-Allow-Origin", "*");
    res.setHeader("Cache-Control", "s-maxage=60, stale-while-revalidate=300");

    if (!response.ok) {
      return res.status(response.status).send(text);
    }

    res.setHeader("Content-Type", "application/json");
    return res.status(200).send(text);
  } catch (error) {
    return res.status(500).json({
      error: "Failed to contact Enka Network"
    });
  }
}
