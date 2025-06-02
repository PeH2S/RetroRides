<style>
.hero-section {
    width: 100%;
    height: 100vh;
    background: linear-gradient(to right, #30849b, #004E64);
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 0;
    margin: 0;
}

.hero-content {
    max-width: 1140px;
    width: 100%;
    padding: 0 20px;
}


.filtros .filtro-item {
  background: #333;
  color: white;
  padding: 8px 15px;
  border-radius: 8px;
  margin: 0 5px;
  display: flex;
  align-items: center;
  gap: 5px;
  font-weight: bold;
  cursor: pointer;
}

.filtros .filtro-item input[type="checkbox"] {
  accent-color: white;
  margin: 0;
}

.search-box {
  background: white;
  border-radius: 10px;
  overflow: hidden;
  display: flex;
  width: 500px;
  max-width: 90%;
}

.search-input {
  border: none;
  padding: 12px 15px;
  flex: 1;
  font-size: 16px;
}

.search-input:focus {
  outline: none;
}

.search-button {
  background: #013746;
  border: none;
  padding: 0 20px;
  color: white;
  font-size: 20px;
  cursor: pointer;
  display: flex;
  align-items: center;
  justify-content: center;
}

</style>
<section class="hero-section text-center d-flex align-items-center">
  <div class="hero-content mx-auto">
    <div class="filtros d-flex justify-content-center mb-3">
      <label class="filtro-item">
        <input type="checkbox" checked>
        <span>0 km</span>
      </label>
      <label class="filtro-item">
        <input type="checkbox" checked>
        <span>Usados</span>
      </label>
      <label class="filtro-item">
        <input type="checkbox">
        <span>Apenas com financiamento</span>
      </label>
    </div>

    <div class="search-bar d-flex justify-content-center">
        <form action="{{ route('search.cars') }}" method="GET" class="search-box d-flex">
            <input type="text" name="q" class="search-input" placeholder="Busque por marca e modelo">
            <button type="submit" class="search-button">
                <i class="bi bi-search"></i>
            </button>
        </form>
    </div>

    <p class="mt-4 text-white">
      <i class="bi bi-geo-alt-fill"></i> Presidente Prudente - SP
    </p>
  </div>
</section>
