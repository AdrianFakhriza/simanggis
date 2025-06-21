const API_URL = "https://simanggis.pro/api";

export async function logout(token) {
  const res = await fetch(`${API_URL}/logout`, {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
      Authorization: `Bearer ${token}`,
    },
  });
  if (!res.ok) throw new Error("Logout gagal");
  return await res.json();
}
