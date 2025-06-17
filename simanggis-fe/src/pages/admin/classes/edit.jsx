import React, { useEffect, useState } from "react";
import { editClass, getClassDetail } from "../../_services/classes";

export default function EditClass({ match, history }) {
  const [form, setForm] = useState({ class_name: "", description: "", teacher_id: "" });
  const [loading, setLoading] = useState(false);
  const [error, setError] = useState("");
  const [success, setSuccess] = useState("");

  const token = localStorage.getItem("token");
  const classId = match?.params?.id;

  useEffect(() => {
    async function fetchData() {
      try {
        const data = await getClassDetail(classId, token);
        setForm({
          class_name: data.class_name || "",
          description: data.description || "",
          teacher_id: data.teacher_id || "",
        });
      } catch (e) {
        setError(e.message);
      }
    }
    fetchData();
  }, [classId, token]);

  const handleChange = (e) => setForm({ ...form, [e.target.name]: e.target.value });

  const handleSubmit = async (e) => {
    e.preventDefault();
    setLoading(true);
    setError("");
    setSuccess("");
    try {
      await editClass(classId, form, token);
      setSuccess("Kelas berhasil diupdate!");
      setTimeout(() => history.push("/admin/classes"), 1000);
    } catch (e) {
      setError(e.message);
    }
    setLoading(false);
  };

  return (
    <form onSubmit={handleSubmit}>
      <h2>Edit Kelas</h2>
      {error && <div style={{ color: "red" }}>{error}</div>}
      {success && <div style={{ color: "green" }}>{success}</div>}
      <input name="class_name" placeholder="Nama Kelas" value={form.class_name} onChange={handleChange} required />
      <input name="description" placeholder="Deskripsi" value={form.description} onChange={handleChange} />
      <input name="teacher_id" placeholder="ID Guru" value={form.teacher_id} onChange={handleChange} required />
      <button type="submit" disabled={loading}>
        {loading ? "Loading..." : "Simpan"}
      </button>
    </form>
  );
}
