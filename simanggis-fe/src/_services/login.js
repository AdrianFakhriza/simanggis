export async function login({ email, password }) {
  const res = await fetch("https://simanggis.pro/api/login", {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify({ email, password }),
  });
  const data = await res.json();
  if (!res.ok) throw new Error(data.error || "Login gagal");
  return data;
}
