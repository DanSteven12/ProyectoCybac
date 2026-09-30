<style>
/* Diseño visual compartido del módulo de usuarios. */
.users-design { color:#31465c; font-family:'Segoe UI',sans-serif; margin-top:1.5rem !important; padding-bottom:2rem; }
.users-design > .row > div { width:100%; max-width:1440px; }
.users-design.users-form > .row > div { max-width:1080px; }
.users-design .card { border:1px solid #e1e7ef !important; border-radius:20px; overflow:hidden; box-shadow:0 12px 40px rgba(23,50,79,.08) !important; }
.users-design .card-header { background:linear-gradient(115deg,#17324f,#244d72) !important; border:0 !important; padding:1.65rem 2rem !important; }
.users-design .card-header h2 { font-size:1.45rem !important; letter-spacing:.025em; line-height:1.4; }
.users-design .card-header h2 > i { color:#ffaf83; }
.users-design .card-body { background:#fff !important; border:0 !important; padding:1.75rem !important; }
.users-design .card-body.p-0 { padding:0 !important; margin-top:1.5rem; }
.users-design label { color:#31465c !important; font-size:.92rem !important; font-weight:600 !important; }
.users-design .form-control,.users-design .form-select,.users-design .input,.users-design .circle-select { background-color:#f8fafc !important; color:#26374a !important; border:1px solid #d7e0ea !important; border-radius:10px !important; font-family:inherit !important; font-size:.96rem !important; letter-spacing:normal !important; min-height:46px; padding:.7rem .9rem !important; box-shadow:none !important; animation:none !important; transform:none !important; opacity:1 !important; width:100%; }
.users-design .input { padding-left:2.65rem !important; }
.users-design .circle-select { padding-right:2.65rem !important; }
.users-design .circle-select-container { height:46px !important; }
.users-design .input::placeholder,.users-design .form-control::placeholder { color:#8795a5 !important; font-size:.88rem; }
.users-design .form-control:focus,.users-design .form-select:focus,.users-design .input:focus,.users-design .circle-select:focus { background-color:#fff !important; border-color:#477baa !important; box-shadow:0 0 0 3px rgba(71,123,170,.14) !important; outline:none; }
.users-design .form-control.is-invalid,.users-design .form-select.is-invalid { border-color:#dc3545 !important; }
.users-design .form-control:disabled,.users-design .form-select:disabled { background-color:#e9eef3 !important; color:#738194 !important; }
.users-design .input-container::after { content:none !important; }
.users-design .input-icon,.users-design .select-icon { color:#6b8095 !important; font-size:1rem; }
.users-design small { color:#7a8797 !important; font-size:.78rem !important; line-height:1.6; }
.users-design .invalid-feedback { font-size:.82rem !important; color:#bf3341 !important; }
.users-design .form-check { padding-top:.5rem; padding-bottom:.5rem; }
.users-design .form-check-input:checked { background-color:#244d72; border-color:#244d72; }
.users-design .btn { border-radius:10px !important; border:1px solid transparent !important; padding:.7rem 1.05rem !important; font-size:.88rem !important; font-weight:600 !important; min-width:auto !important; box-shadow:none !important; }
.users-design .btn:hover { filter:brightness(.94); transform:none !important; }
.users-design .btn:focus-visible { outline:3px solid #8fb6d6; outline-offset:3px; }
.users-design button[type="submit"],.users-design a[style*="#FF6B35"] { background-color:#e85d2a !important; color:#fff !important; }
.users-design a[style*="#2EC4B6"] { background-color:#eaf1f7 !important; color:#244d72 !important; border-color:#d7e3ee !important; }
.users-design .card-header a[style*="#0A2647"] { background-color:rgba(255,255,255,.1) !important; border-color:rgba(255,255,255,.22) !important; }
.users-design .table-responsive { border:1px solid #e5ebf2; border-radius:12px; }
.users-design .table { --bs-table-hover-bg:#f3f7fb; color:#31465c; }
.users-design .table thead tr,.users-design .table th { background:#eef3f8 !important; color:#50677e !important; }
.users-design .table th { font-size:.76rem !important; font-weight:700 !important; padding:1rem .85rem !important; letter-spacing:.035em; border-bottom:1px solid #dfe7f0; white-space:nowrap; }
.users-design .table td { font-size:.88rem !important; padding:1rem .85rem !important; border-bottom:1px solid #edf1f6; color:#31465c !important; }
.users-design .table tbody tr { background-color:#fff !important; border-color:#edf1f6 !important; }
.users-design .table tbody tr:nth-child(even) { background-color:#fafbfd !important; }
.users-design .table td .btn { font-size:.8rem !important; padding:.5rem .75rem !important; }
.users-design .badge { font-size:.75rem !important; padding:.45rem .7rem; font-weight:600; }
.users-design .badge[style*="#2EC4B6"] { background-color:#e2f5ec !important; color:#23734d !important; }
.users-design .badge[style*="#FF6B35"] { background-color:#fff0e8 !important; color:#ac4d24 !important; }
.users-design .alert { background-color:#edf6f4 !important; color:#2c6559 !important; border:1px solid #d3e9e2 !important; border-radius:12px; margin:1rem 0 !important; padding:1rem !important; font-size:.9rem !important; }
.users-design .alert strong,.users-design .alert .fs-5 { font-size:.9rem !important; }
.users-design .alert-error { background-color:#fff1f2 !important; color:#ab3541 !important; border-color:#f3d3d7 !important; }
.users-design .alert .btn-close { filter:none !important; }
.users-design .card-footer { background:#fafbfd !important; border-top:1px solid #e5ebf2 !important; padding:1.2rem !important; }
.users-design .card-footer div { font-size:.85rem !important; }
.users-design .pagination { gap:.3rem; margin-bottom:0; }
.users-design .pagination .page-link { border-radius:8px !important; border:1px solid #e1e7ef; font-size:.85rem; color:#244d72; }
.users-design .pagination .active .page-link { background:#244d72; border-color:#244d72; color:white; }
.users-design.users-form form > .row { --bs-gutter-x:2.25rem; }
.users-design.users-form form > .d-flex:last-child { border-top:1px solid #e5ebf2; padding-top:1.25rem; margin-top:1.5rem !important; }
@media (max-width:767px) {
.users-design { padding-left:.5rem !important; padding-right:.5rem !important; margin-top:.75rem !important; }
.users-design .card { border-radius:14px; }
.users-design .card-header,.users-design .card-body { padding:1.15rem !important; }
.users-design .card-header h2 { font-size:1.15rem !important; margin-bottom:0 !important; }
.users-design .card-header .w-100 { flex-wrap:wrap; gap:1rem; }
.users-design .table { min-width:900px; }
.users-design .wrap-text { max-width:180px !important; }
.users-design .card-footer > .d-flex,.users-design.users-form form > .d-flex:last-child { flex-wrap:wrap; gap:1rem; }
}
@media (prefers-reduced-motion:reduce) { .users-design * { animation:none !important; transition:none !important; } }
</style>