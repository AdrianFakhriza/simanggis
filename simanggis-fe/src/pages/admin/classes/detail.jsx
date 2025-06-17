import React, { useEffect, useState } from "react";
import { getClassDetail } from "../../_services/classes";

export default function ClassDetail({ match }) {
  const [data, setData] = useState(null);
  const [error, setError] = useState("");
  const token = localStorage.getItem("token");
  const classId = match?.params?.id;

  useEffect(() => {
    async function fetchData() {
      try {
        const detail = await getClassDetail(classId, token);
        setData(detail);
      } catch (e) {
        setError(e.message);
      }
    }
    fetchData();
  }, [classId, token]);

  if (error) return <div style={{ color: "red" }}>{error}</div>;
  if (!data) return <div>Loading...</div>;

  return (
    <div>
      <h2>Detail Kelas</h2>
      <div>Nama Kelas: {data.class_name}</div>
      <div>Deskripsi: {data.description}</div>
      <div>ID Guru: {data.teacher_id}</div>
      {/* Tambahkan detail lain sesuai kebutuhan */}
    </div>
  );
}
