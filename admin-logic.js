// Your original (corrected) base data structure
const sections = {
    shops: {
        title: "Dyqanet", // Fixed typo: matches your Albanian section naming
        fields: ["Emërtimi", "Kati", "Siperfaqja (m2)", "Statusi"],
        data: [{id: 1, emri: "Zara", kati: "1", sip: "120", status: "Aktiv"}]
    },
    tenants: {
        title: "Qiramarrësit",
        fields: ["Emri i Kompanisë", "Kontakt Personi", "Email", "Telefoni"],
        data: [{id: 1, emri: "Inditex", kontakt: "Filan Fisteku", email: "info@zara.com", tel: "044111"}]
    },
    contracts: {
        title: "Kontratat e Qirasë",
        fields: ["ID Dyqani", "ID Qiramarrësi", "Qiraja Mujore", "Data Fillimit"],
        data: [{id: 1, dyqan: 1, qiramarres: 1, cmimi: "1500€", data: "2026-01-01"}]
    }
};

// Core function to add new stores/shops to your shops dataset
function addNewShop(shopInput) {
    // Generate a unique ID for the new shop (no duplicates, even if you delete old entries)
    const existingShopIds = sections.shops.data.map(shop => shop.id);
    const newShopId = existingShopIds.length ? Math.max(...existingShopIds) + 1 : 1;

    // Validate all required shop fields are provided (matches your data schema)
    const requiredFields = ["emri", "kati", "sip", "status"];
    const missingFields = requiredFields.filter(field => !(field in shopInput));
    if (missingFields.length) throw new Error(`Could not add shop: missing fields - ${missingFields.join(", ")}`);

    // Format and add the new shop to your data
    const newShop = {
        id: newShopId,
        emri: shopInput.emri,
        kati: shopInput.kati,
        sip: shopInput.sip,
        status: shopInput.status
    };
    sections.shops.data.push(newShop);

    console.log(`Added new shop: ${newShop.emri} (ID: ${newShopId})`);
    return newShop;
}

function listAllShops() {
    console.log(`\n=== ${sections.shops.title} (${sections.shops.data.length} total) ===`);
    sections.shops.data.forEach(shop => {
        console.log(`ID: ${shop.id} | Emri: ${shop.emri} | Kati: ${shop.kati} | Siperfaqja: ${shop.sip}m2 | Statusi: ${shop.status}`);
    });
}

function showSection(key) {
    const section = sections[key];
    document.getElementById('section-title').innerText = section.title;
    
    // Përditëso Tabelën
    const tbody = document.getElementById('table-body');
    tbody.innerHTML = section.data.map(item => `
        <tr>
            <td>${item.id}</td>
            <td>${Object.values(item)[1]}</td>
            <td>${Object.values(item)[2]}</td>
            <td>${Object.values(item)[3]}</td>
            <td><span style="color: #2ed573">OK</span></td>
            <td><button onclick="alert('Edit')">Edito</button></td>
        </tr>
    `).join('');

    // Përgatit fushat e Formës për Modal
    const formFields = document.getElementById('form-fields');
    formFields.innerHTML = section.fields.map(f => `
        <label>${f}</label>
        <input type="text" placeholder="${f}...">
    `).join('');
}

function openModal() {
    document.getElementById('modal').style.display = 'block';
}

function closeModal() {
    document.getElementById('modal').style.display = 'none';
}

sections = {
    shops: {
        title: "Menaxhimi i Dyqaneve",
        fields: ["Emërtimi", "Kategoria_ID", "Pronari_ID", "Kati", "Numri_Njësisë", "Sipërfaqja_m2", "Statusi", "Data_Hapjes", "Pershkrimi"],
        data: [{id: 1, emri: "Zara", kat: "1", status: "Hapur"}]
    },
    categories: {
        title: "Kategoritë e Dyqaneve",
        fields: ["Emërtimi", "Pershkrimi", "Ikona"],
        data: [{id: 1, emri: "Modë", desc: "Veshje dhe aksesorë"}]
    },
    tenants: {
        title: "Qiramarrësit (Tenants)",
        fields: ["Emërtimi i Kompanisë", "Kontakti", "Email", "Telefoni", "Nr_Biznesit", "Adresa"],
        data: [{id: 1, emri: "Inditex Group", kontakt: "044123456", email: "info@inditex.com"}]
    },
    contracts: {
        title: "Kontratat e Qirasë",
        fields: ["Dyqani_ID", "Qiramarrësi_ID", "Data_Fillimit", "Data_Përfundimit", "Qiraja_Mujore", "Depozita", "Statusi"],
        data: [{id: 1, dyqan: "Dyqani 10", qiramarres: "Inditex", qiraja: "1200€"}]
    },
    spaces: {
        title: "Hapësirat me Qira",
        fields: ["Emërtimi", "Lloji", "Kati", "Siperfaqja_m2", "Çmimi_m2", "Statusi"],
        data: [{id: 1, emri: "Hapësira A1", lloji: "Kioskë", status: "E lirë"}]
    },
    maintenance: {
        title: "Kërkesat e Mirëmbajtjes",
        fields: ["Dyqani_ID", "Lloji", "Pershkrimi", "Prioriteti", "Statusi", "Tekniku_ID"],
        data: [{id: 1, lloji: "Elektrike", prioriteti: "Lartë", status: "Në proces"}]
    },
    events: {
        title: "Ngjarjet (Events)",
        fields: ["Titulli", "Pershkrimi", "Data_Fillimit", "Data_Përfundimit", "Lokacioni", "Buxheti"],
        data: [{id: 1, titulli: "Festat e Fundvitit", data: "2026-12-20", status: "Planifikuar"}]
    },
    invoices: {
        title: "Faturat",
        fields: ["Qiramarrësi_ID", "Kontrata_ID", "Muaji", "Viti", "Shuma_Totale", "Statusi"],
        data: [{id: 1, qiramarres: "Nike", muaji: "Mars", total: "1550€"}]
    },
    payments: {
        title: "Pagesat",
        fields: ["Fatura_ID", "Shuma", "Data_Pagesës", "Metoda_Pagesës", "Referenca", "Statusi"],
        data: [{id: 1, fatura: "FAT-001", shuma: "1550€", metoda: "Bankë"}]
    },
    visitors: {
        title: "Statistikat e Vizitorëve",
        fields: ["Data", "Ora", "Numri_Vizitorëve", "Kati", "Metoda_Numërimit"],
        data: [{id: 1, data: "2026-03-21", nr: "1250", kati: "0"}]
    },
    announcements: {
        title: "Njoftimet",
        fields: ["Titulli", "Përmbajtja", "Lloji", "Data_Publikimit", "Data_Skadimit", "A_është_aktiv"],
        data: [{id: 1, titulli: "Zbritje Verore", lloji: "Marketing", aktiv: "Po"}]
    }
};

// Modifikimi i funksionit showSection për të përshtatur tabelën dinamike
function showSection(key) {
    const section = sections[key];
    document.getElementById('section-title').innerText = section.title;
    
    const thead = document.querySelector('.data-table thead tr');
    const tbody = document.getElementById('table-body');

    // Krijo kokat e tabelës në bazë të fushave (vetëm 4 të parat për pamje të pastër)
    let headerHTML = `<th>ID</th>`;
    section.fields.slice(0, 4).forEach(f => headerHTML += `<th>${f}</th>`);
    headerHTML += `<th>Veprimet</th>`;
    thead.innerHTML = headerHTML;

    // Mbush tabelën me të dhëna
    tbody.innerHTML = section.data.map(item => {
        let rows = `<td>${item.id}</td>`;
        // Marrim vlerat e objektit përveç ID-së
        const values = Object.values(item).slice(1);
        values.forEach(v => rows += `<td>${v}</td>`);
        rows += `<td>
                    <button class="btn-edit" onclick="openModal()">Edito</button>
                    <button class="btn-delete" style="background:#ff4757; color:white; border:none; padding:5px; cursor:pointer;">Fshi</button>
                 </td>`;
        return `<tr>${rows}</tr>`;
    }).join('');

    // Përgatit fushat e Formës (Modal)
    const formFields = document.getElementById('form-fields');
    formFields.innerHTML = section.fields.map(f => `
        <div class="form-group">
            <label style="display:block; margin-top:10px;">${f}</label>
            <input type="text" placeholder="Shëno ${f}..." style="width:100%; padding:8px; background:#2a2a2a; border:1px solid #444; color:white;">
        </div>
    `).join('');
}