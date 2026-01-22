
import React, { useState } from 'react';
import VillageForm from './VillageForm';


function App() {
  const [villageData, setVillageData] = useState(null);
  const [error, setError] = useState(null);
  const [loading, setLoading] = useState(false);

  const handleVillageSubmit = async (villageId) => {
    setLoading(true);
    setError(null);
    setVillageData(null);
    try {
      if (!villageId) {
        setError('Informe o ID da vila.');
        setLoading(false);
        return;
      }
      const backendUrl = import.meta.env ? import.meta.env.REACT_APP_BACKEND_URL : undefined;
      const apiBase = backendUrl || 'http://localhost:8080';
      const res = await fetch(`${apiBase}/api/village/${encodeURIComponent(villageId)}`);
      if (!res.ok) throw new Error('Erro ao buscar dados da vila');
      const data = await res.json();
      setVillageData(data);
    } catch (err) {
      setError(err.message);
    } finally {
      setLoading(false);
    }
  };

  return (
    <div>
      <h1>COCautoplanner</h1>
      <p>Planeje o upgrade da sua vila do Clash of Clans!</p>
      <VillageForm onSubmit={handleVillageSubmit} />
      {loading && <p>Carregando...</p>}
      {error && <p style={{color: 'red'}}>{error}</p>}
      {villageData && !villageData.error && (
        <div style={{background: '#f7f7f7', borderRadius: 8, padding: 16, marginTop: 16, textAlign: 'left'}}>
          <h2>Vila: {villageData.name} ({villageData.tag})</h2>
          <p><b>Nível do Centro da Vila:</b> {villageData.townHallLevel}</p>
          <p><b>Nível de Experiência:</b> {villageData.expLevel}</p>
          <p><b>Troféus:</b> {villageData.trophies}</p>
          <p><b>Melhor Troféu:</b> {villageData.bestTrophies}</p>
          <p><b>Clã:</b> {villageData.clan ? villageData.clan.name + ' (' + villageData.clan.tag + ')' : 'Sem clã'}</p>
          <h3>Heróis</h3>
          <ul>
            {villageData.heroes && villageData.heroes.map(hero => (
              <li key={hero.name}><b>{hero.name}</b>: nível {hero.level} / {hero.maxLevel}</li>
            ))}
          </ul>
          <h3>Tropas</h3>
          <ul style={{columns: 2}}>
            {villageData.troops && villageData.troops.map(troop => (
              <li key={troop.name + troop.village}><b>{troop.name}</b>: nível {troop.level} / {troop.maxLevel} ({troop.village})</li>
            ))}
          </ul>
        </div>
      )}
      {villageData && villageData.error && (
        <p style={{color: 'red'}}>{villageData.error}</p>
      )}
    </div>
  );
}

export default App;
