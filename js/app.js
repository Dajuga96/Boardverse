(function () {
    "use strict";

    const btnMenu = document.getElementById("btnMenu");
    const nav = document.getElementById("navPrincipal");

    if (btnMenu && nav) {
        btnMenu.addEventListener("click", () => {
            nav.classList.toggle("abierto");
        });
    }

    const botonesTab = document.querySelectorAll("[data-tab]");
    const paneles = document.querySelectorAll("[data-panel]");

    botonesTab.forEach(btn => {
        btn.addEventListener("click", () => {
            const destino = btn.dataset.tab;

            botonesTab.forEach(b => b.classList.toggle("activo", b === btn));
            paneles.forEach(p => p.classList.toggle("oculto", p.dataset.panel !== destino));
        });
    });

    document.querySelectorAll("[data-qty]").forEach(btn => {
        btn.addEventListener("click", () => {
            const delta = parseInt(btn.dataset.qty, 10);
            const input = btn.closest(".cantidad").querySelector("input[type=number]");
            const actual = parseInt(input.value, 10) || 1;
            const nuevo = Math.max(1, Math.min(99, actual + delta));
            input.value = nuevo;
            input.dispatchEvent(new Event("change", { bubbles: true }));
        });
    });

    const tablaCarrito = document.getElementById("tablaCarrito");
    if (tablaCarrito) {
        const resumenSub = document.getElementById("resumenSubtotal");
        const resumenTot = document.getElementById("resumenTotal");
        const vacio = document.getElementById("carritoVacio");
        const envio = 4.95;

        const fmt = n => n.toFixed(2).replace(".", ",") + " €";

        const recalcular = () => {
            let subtotal = 0;
            const filas = tablaCarrito.querySelectorAll("tbody tr");
            filas.forEach(tr => {
                const precio = parseFloat(tr.dataset.precio) || 0;
                const cant = parseInt(tr.querySelector("input[type=number]").value, 10) || 1;
                const sub = precio * cant;
                tr.querySelector(".subtotal").textContent = fmt(sub);
                subtotal += sub;
            });
            if (resumenSub) resumenSub.textContent = fmt(subtotal);
            if (resumenTot) resumenTot.textContent = fmt(subtotal > 0 ? subtotal + envio : 0);

            if (filas.length === 0) {
                tablaCarrito.classList.add("oculto");
                if (vacio) vacio.classList.remove("oculto");
            }
        };

        tablaCarrito.addEventListener("click", (e) => {
            const btn = e.target.closest("[data-quitar]");
            if (!btn) return;
            const fila = btn.closest("tr");
            if (fila) fila.remove();
            recalcular();
        });

        tablaCarrito.addEventListener("change", (e) => {
            if (e.target.matches("input[type=number]")) recalcular();
        });

        recalcular();
    }

    const formFiltros = document.getElementById("formFiltros");
    if (formFiltros) {
        formFiltros.addEventListener("submit", (e) => {
            e.preventDefault();
            const datos = new FormData(formFiltros);
            const params = new URLSearchParams(datos).toString();
            console.log("Filtros enviados:", params);
        });
    }

    document.querySelectorAll("[data-filtro]").forEach(btn => {
        btn.addEventListener("click", () => {
            document.querySelectorAll("[data-filtro]").forEach(b => b.classList.remove("activo"));
            btn.classList.add("activo");
        });
    });

    const formComprar = document.getElementById("formComprar");
    if (formComprar) {
        formComprar.addEventListener("submit", (e) => {
            e.preventDefault();
            const cant = formComprar.querySelector("#cant").value;
            alert("Añadido al carrito (" + cant + " ud.)");
        });
    }

})();
