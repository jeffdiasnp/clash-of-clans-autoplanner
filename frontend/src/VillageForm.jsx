import React, { useState } from 'react';

function VillageForm({ onSubmit }) {
  const [villageId, setVillageId] = useState('');

  const handleSubmit = (e) => {
    e.preventDefault();
    if (villageId.trim()) {
      onSubmit(villageId.trim());
    }
  };

  return (
    <form onSubmit={handleSubmit}>
      <label htmlFor="villageId">ID da Vila:</label>
      <input
        id="villageId"
        type="text"
        value={villageId}
        onChange={e => setVillageId(e.target.value)}
        placeholder="#ABC123"
        required
      />
      <button type="submit">Buscar</button>
    </form>
  );
}

export default VillageForm;
