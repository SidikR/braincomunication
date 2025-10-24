 <script>
        async function getNameById(id, apiEndpoint) {
            try {
                const response = await axios.get(`http://localhost:8001/api/${apiEndpoint}/${id}`);
                return response.data.data.name; // Adjust with the appropriate property
            } catch (error) {
                console.error(`Failed to fetch ${apiEndpoint} name:`, error);
                return null;
            }
        }

        document.addEventListener('DOMContentLoaded', async function() {
            // Assuming $stunting->kecamatan and $stunting->desa are the IDs of kecamatan and desa
            const kecamatanId = "{{ $stunting->kecamatan }}";
            const desaId = "{{ $stunting->desa }}";

            const kecamatanData = await getNameById(kecamatanId, 'data-kecamatan');
            const desaData = await getNameById(desaId, 'data-desa');

            // Update the content of the options displaying kecamatan and desa names
            const kecamatanSelect = document.getElementById('kecamatan');
            const kecamatanOption = kecamatanSelect.querySelector(`option[value="${kecamatanId}"]`);

            const desaSelect = document.getElementById('desa');
            const desaOption = desaSelect.querySelector(`option[value="${desaId}"]`);

            if (kecamatanOption) {
                kecamatanOption.textContent = kecamatanData ? kecamatanData : 'N/A';
            } else {
                console.error('Option not found for kecamatan:', kecamatanId);
            }

            if (desaOption) {
                desaOption.textContent = desaData ? desaData : 'N/A';
            } else {
                console.error('Option not found for desa:', desaId);
            }
        });
    </script>