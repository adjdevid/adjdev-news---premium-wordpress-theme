import React, { useState, useMemo } from 'react';
import {
  Download,
  FileCode,
  Folder,
  FolderOpen,
  Layers,
  Settings,
  Check,
  Copy,
  Sparkles,
  Monitor,
  Moon,
  Sun,
  ShieldCheck,
  Zap,
  Search,
  BookOpen,
  ArrowRight,
  Sliders,
  CheckCircle2,
  Terminal,
  PackageCheck
} from 'lucide-react';
import {
  THEME_NAME,
  THEME_VERSION,
  THEME_ZIP_NAME,
  THEME_ZIP_URL,
  THEME_ZIP_SIZE,
  THEME_FILES,
  THEME_TEMPLATES,
  ThemeFile,
  TemplateItem
} from './themeData';

export default function App() {
  const [activeTab, setActiveTab] = useState<'download' | 'templates' | 'options' | 'files' | 'builder' | 'guide'>('download');
  const [selectedFile, setSelectedFile] = useState<ThemeFile>(() => {
    return THEME_FILES.find(f => f.path === 'functions.php') || THEME_FILES[0];
  });
  const [fileSearch, setFileSearch] = useState('');
  const [copiedCode, setCopiedCode] = useState(false);
  const [activeTemplateId, setActiveTemplateId] = useState('news-modern');
  const [selectedTemplateForModal, setSelectedTemplateForModal] = useState<TemplateItem | null>(null);

  // Theme Options Simulator State
  const [simSiteLayout, setSimSiteLayout] = useState('fullwidth');
  const [simHeaderLayout, setSimHeaderLayout] = useState('default');
  const [simPrimaryColor, setSimPrimaryColor] = useState('#1062fe');
  const [simSecondaryColor, setSimSecondaryColor] = useState('#0f172a');
  const [simAccentColor, setSimAccentColor] = useState('#f43f5e');
  const [simDarkMode, setSimDarkMode] = useState(true);
  const [simBreakingNews, setSimBreakingNews] = useState(true);
  const [simTOC, setSimTOC] = useState(true);
  const [simReadingProgress, setSimReadingProgress] = useState(true);
  const [simActiveTab, setSimActiveTab] = useState('general');
  const [copiedJson, setCopiedJson] = useState(false);

  // File tree filtering
  const filteredFiles = useMemo(() => {
    if (!fileSearch.trim()) return THEME_FILES;
    const q = fileSearch.toLowerCase();
    return THEME_FILES.filter(f => f.path.toLowerCase().includes(q));
  }, [fileSearch]);

  const handleCopyCode = () => {
    if (selectedFile) {
      navigator.clipboard.writeText(selectedFile.content);
      setCopiedCode(true);
      setTimeout(() => setCopiedCode(false), 2000);
    }
  };

  const activeTemplate = useMemo(() => {
    return THEME_TEMPLATES.find(t => t.id === activeTemplateId) || THEME_TEMPLATES[0];
  }, [activeTemplateId]);

  const handleActivateTemplate = (tpl: TemplateItem) => {
    setActiveTemplateId(tpl.id);
    if (tpl.config) {
      if (tpl.config.color_primary) setSimPrimaryColor(tpl.config.color_primary);
      if (tpl.config.color_secondary) setSimSecondaryColor(tpl.config.color_secondary);
      if (tpl.config.color_accent) setSimAccentColor(tpl.config.color_accent);
      if (tpl.config.header_layout) setSimHeaderLayout(tpl.config.header_layout);
      if (tpl.config.site_layout) setSimSiteLayout(tpl.config.site_layout);
    }
  };

  const simulatedConfigJson = useMemo(() => {
    return JSON.stringify({
      active_template: activeTemplateId,
      site_layout: simSiteLayout,
      header_layout: simHeaderLayout,
      color_primary: simPrimaryColor,
      color_secondary: simSecondaryColor,
      color_accent: simAccentColor,
      dark_mode_enable: simDarkMode,
      breaking_news_enable: simBreakingNews,
      single_toc_enable: simTOC,
      reading_progress_enable: simReadingProgress,
    }, null, 2);
  }, [activeTemplateId, simSiteLayout, simHeaderLayout, simPrimaryColor, simSecondaryColor, simAccentColor, simDarkMode, simBreakingNews, simTOC, simReadingProgress]);

  return (
    <div className="min-h-screen bg-slate-950 text-slate-100 flex flex-col font-sans selection:bg-blue-600 selection:text-white">
      {/* Top Navigation Banner */}
      <header className="border-b border-slate-800 bg-slate-900/80 backdrop-blur sticky top-0 z-50">
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
          <div className="flex items-center gap-3">
            <div className="w-9 h-9 rounded-lg bg-blue-600 flex items-center justify-center font-black text-white shadow-lg shadow-blue-500/25">
              AD
            </div>
            <div>
              <div className="flex items-center gap-2">
                <span className="font-bold text-lg tracking-tight text-white">{THEME_NAME}</span>
                <span className="text-xs font-semibold px-2 py-0.5 rounded bg-blue-500/20 text-blue-400 border border-blue-500/30">
                  v{THEME_VERSION}
                </span>
                <span className="text-xs font-medium px-2 py-0.5 rounded bg-emerald-500/10 text-emerald-400 border border-emerald-500/20 hidden sm:inline-block">
                  WordPress Theme Package
                </span>
              </div>
            </div>
          </div>

          <div className="flex items-center gap-3">
            <a
              href={THEME_ZIP_URL}
              download={THEME_ZIP_NAME}
              className="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-blue-600 hover:bg-blue-500 text-white font-semibold text-sm transition-all shadow-lg shadow-blue-600/30 hover:shadow-blue-500/50 active:scale-95"
            >
              <Download className="w-4 h-4" />
              <span>Download Theme (.zip)</span>
              <span className="text-xs bg-blue-700/80 px-1.5 py-0.5 rounded text-blue-200">{THEME_ZIP_SIZE}</span>
            </a>
          </div>
        </div>
      </header>

      {/* Main Navigation Tabs */}
      <div className="border-b border-slate-800 bg-slate-900/50">
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <nav className="flex space-x-1 sm:space-x-4 overflow-x-auto py-2 scrollbar-none">
            <button
              onClick={() => setActiveTab('download')}
              className={`flex items-center gap-2 px-3 py-2 rounded-md text-sm font-medium transition-colors whitespace-nowrap ${
                activeTab === 'download'
                  ? 'bg-blue-600/20 text-blue-400 border border-blue-500/30'
                  : 'text-slate-400 hover:text-slate-200 hover:bg-slate-800/60'
              }`}
            >
              <Download className="w-4 h-4" />
              Theme Download & Hub
            </button>
            <button
              onClick={() => setActiveTab('templates')}
              className={`flex items-center gap-2 px-3 py-2 rounded-md text-sm font-medium transition-colors whitespace-nowrap ${
                activeTab === 'templates'
                  ? 'bg-blue-600/20 text-blue-400 border border-blue-500/30'
                  : 'text-slate-400 hover:text-slate-200 hover:bg-slate-800/60'
              }`}
            >
              <Layers className="w-4 h-4" />
              Template Library
              <span className="bg-slate-800 text-xs px-1.5 py-0.2 rounded-full text-slate-300">12</span>
            </button>
            <button
              onClick={() => setActiveTab('options')}
              className={`flex items-center gap-2 px-3 py-2 rounded-md text-sm font-medium transition-colors whitespace-nowrap ${
                activeTab === 'options'
                  ? 'bg-blue-600/20 text-blue-400 border border-blue-500/30'
                  : 'text-slate-400 hover:text-slate-200 hover:bg-slate-800/60'
              }`}
            >
              <Settings className="w-4 h-4" />
              Theme Options Simulator
            </button>
            <button
              onClick={() => setActiveTab('files')}
              className={`flex items-center gap-2 px-3 py-2 rounded-md text-sm font-medium transition-colors whitespace-nowrap ${
                activeTab === 'files'
                  ? 'bg-blue-600/20 text-blue-400 border border-blue-500/30'
                  : 'text-slate-400 hover:text-slate-200 hover:bg-slate-800/60'
              }`}
            >
              <FileCode className="w-4 h-4" />
              Theme Code Explorer
              <span className="bg-slate-800 text-xs px-1.5 py-0.2 rounded-full text-slate-300">{THEME_FILES.length}</span>
            </button>
            <button
              onClick={() => setActiveTab('builder')}
              className={`flex items-center gap-2 px-3 py-2 rounded-md text-sm font-medium transition-colors whitespace-nowrap ${
                activeTab === 'builder'
                  ? 'bg-blue-600/20 text-blue-400 border border-blue-500/30'
                  : 'text-slate-400 hover:text-slate-200 hover:bg-slate-800/60'
              }`}
            >
              <Terminal className="w-4 h-4" />
              ADJDEV Builder API
            </button>
            <button
              onClick={() => setActiveTab('guide')}
              className={`flex items-center gap-2 px-3 py-2 rounded-md text-sm font-medium transition-colors whitespace-nowrap ${
                activeTab === 'guide'
                  ? 'bg-blue-600/20 text-blue-400 border border-blue-500/30'
                  : 'text-slate-400 hover:text-slate-200 hover:bg-slate-800/60'
              }`}
            >
              <BookOpen className="w-4 h-4" />
              Installation Guide
            </button>
          </nav>
        </div>
      </div>

      {/* Main Content Area */}
      <main className="flex-1 max-w-7xl w-full mx-auto px-4 sm:px-6 lg:px-8 py-8">
        {/* TAB 1: DOWNLOAD & HUB */}
        {activeTab === 'download' && (
          <div className="space-y-10">
            {/* Hero Card */}
            <div className="relative overflow-hidden rounded-2xl bg-gradient-to-br from-slate-900 via-slate-900 to-blue-950 border border-slate-800 p-8 sm:p-12 shadow-2xl">
              <div className="relative z-10 max-w-3xl space-y-6">
                <div className="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-blue-500/10 border border-blue-500/20 text-blue-400 text-xs font-semibold uppercase tracking-wider">
                  <Sparkles className="w-3.5 h-3.5" />
                  Official WordPress Theme Package Built in Workspace
                </div>
                <h1 className="text-3xl sm:text-5xl font-extrabold text-white tracking-tight leading-tight">
                  ADJDEV News <span className="text-blue-500">WordPress Theme</span>
                </h1>
                <p className="text-base sm:text-lg text-slate-300 leading-relaxed">
                  Theme berita premium original untuk portal nasional, regional, teknologi, dan magazine modern. Dilengkapi dengan arsitektur modular, <strong>Dynamic Template Library</strong> (12 template terdeteksi otomatis), dashboard Theme Options 36 kategori, dan siap terintegrasi mulus dengan plugin <strong>ADJDEV Builder</strong>.
                </p>

                {/* Primary Action Buttons */}
                <div className="flex flex-wrap gap-4 pt-2">
                  <a
                    href={THEME_ZIP_URL}
                    download={THEME_ZIP_NAME}
                    className="inline-flex items-center gap-3 px-6 py-3.5 rounded-xl bg-blue-600 hover:bg-blue-500 text-white font-bold text-base transition-all shadow-xl shadow-blue-600/30 hover:shadow-blue-500/50 hover:-translate-y-0.5 active:translate-y-0"
                  >
                    <Download className="w-5 h-5" />
                    <span>Download {THEME_ZIP_NAME}</span>
                    <span className="text-xs bg-blue-700 px-2 py-0.5 rounded-md text-blue-100">{THEME_ZIP_SIZE}</span>
                  </a>

                  <button
                    onClick={() => setActiveTab('files')}
                    className="inline-flex items-center gap-2 px-6 py-3.5 rounded-xl bg-slate-800 hover:bg-slate-700 text-slate-200 font-semibold text-base transition-all border border-slate-700"
                  >
                    <FileCode className="w-5 h-5 text-slate-400" />
                    <span>Explore Theme Files ({THEME_FILES.length} Files)</span>
                  </button>

                  <button
                    onClick={() => setActiveTab('templates')}
                    className="inline-flex items-center gap-2 px-6 py-3.5 rounded-xl bg-slate-800 hover:bg-slate-700 text-slate-200 font-semibold text-base transition-all border border-slate-700"
                  >
                    <Layers className="w-5 h-5 text-emerald-400" />
                    <span>View 12 Templates</span>
                  </button>
                </div>
              </div>

              {/* Decorative Background Grid */}
              <div className="absolute right-0 top-0 bottom-0 w-1/3 opacity-10 pointer-events-none hidden lg:block bg-[radial-gradient(#3b82f6_1px,transparent_1px)] [background-size:16px_16px]"></div>
            </div>

            {/* Architecture Highlights */}
            <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
              <div className="p-6 rounded-xl bg-slate-900/60 border border-slate-800 space-y-3">
                <div className="w-10 h-10 rounded-lg bg-emerald-500/10 text-emerald-400 flex items-center justify-center border border-emerald-500/20">
                  <Zap className="w-5 h-5" />
                </div>
                <h3 className="font-bold text-white text-lg">Extreme Performance</h3>
                <p className="text-sm text-slate-400 leading-relaxed">
                  0 jQuery pada frontend. 100% Native Vanilla JS, asset deferral, decoding async, dan optimasi Core Web Vitals (CLS &lt; 0.01).
                </p>
              </div>

              <div className="p-6 rounded-xl bg-slate-900/60 border border-slate-800 space-y-3">
                <div className="w-10 h-10 rounded-lg bg-blue-500/10 text-blue-400 flex items-center justify-center border border-blue-500/20">
                  <Layers className="w-5 h-5" />
                </div>
                <h3 className="font-bold text-white text-lg">Dynamic Template Library</h3>
                <p className="text-sm text-slate-400 leading-relaxed">
                  Folder <code className="text-xs bg-slate-800 px-1 py-0.5 rounded text-blue-300">/templates-library/</code> dipindai otomatis oleh PHP scanner. Template baru cukup ditambahkan tanpa ubah functions.php.
                </p>
              </div>

              <div className="p-6 rounded-xl bg-slate-900/60 border border-slate-800 space-y-3">
                <div className="w-10 h-10 rounded-lg bg-purple-500/10 text-purple-400 flex items-center justify-center border border-purple-500/20">
                  <Sliders className="w-5 h-5" />
                </div>
                <h3 className="font-bold text-white text-lg">36-Tab Theme Options</h3>
                <p className="text-sm text-slate-400 leading-relaxed">
                  Kontrol komprehensif: Logo, Header layouts, Dark Mode, Typography, Colors, Advertisement Slots, Breadcrumbs, dan JSON Backup.
                </p>
              </div>

              <div className="p-6 rounded-xl bg-slate-900/60 border border-slate-800 space-y-3">
                <div className="w-10 h-10 rounded-lg bg-amber-500/10 text-amber-400 flex items-center justify-center border border-amber-500/20">
                  <Terminal className="w-5 h-5" />
                </div>
                <h3 className="font-bold text-white text-lg">ADJDEV Builder Ready</h3>
                <p className="text-sm text-slate-400 leading-relaxed">
                  Dilengkapi Hooks, Filters, Section API, Dynamic Data Tags, CSS design tokens, dan Canvas Blank Template siap untuk plugin visual builder.
                </p>
              </div>
            </div>

            {/* Quick Summary of Current Active Template */}
            <div className="p-6 rounded-xl bg-slate-900 border border-slate-800 flex flex-col md:flex-row items-center justify-between gap-6">
              <div className="flex items-center gap-4">
                <div className="w-14 h-14 rounded-xl bg-blue-600/20 border border-blue-500/30 flex items-center justify-center text-blue-400 font-bold text-xl">
                  {activeTemplate.name.substring(0, 2).toUpperCase()}
                </div>
                <div>
                  <div className="flex items-center gap-2">
                    <h3 className="text-lg font-bold text-white">Active Template: {activeTemplate.name}</h3>
                    <span className="text-xs bg-emerald-500/20 text-emerald-400 px-2 py-0.5 rounded font-medium border border-emerald-500/30">
                      Default Preset
                    </span>
                  </div>
                  <p className="text-sm text-slate-400">{activeTemplate.description}</p>
                </div>
              </div>
              <div className="flex items-center gap-3">
                <button
                  onClick={() => setActiveTab('templates')}
                  className="px-4 py-2 rounded-lg bg-slate-800 hover:bg-slate-700 text-sm font-semibold text-white border border-slate-700"
                >
                  Browse All 12 Presets
                </button>
                <button
                  onClick={() => setActiveTab('options')}
                  className="px-4 py-2 rounded-lg bg-blue-600 hover:bg-blue-500 text-sm font-semibold text-white"
                >
                  Customize in Options
                </button>
              </div>
            </div>
          </div>
        )}

        {/* TAB 2: TEMPLATE LIBRARY */}
        {activeTab === 'templates' && (
          <div className="space-y-6">
            <div className="flex flex-col md:flex-row md:items-center justify-between gap-4">
              <div>
                <h2 className="text-2xl font-bold text-white">ADJDEV Template Library</h2>
                <p className="text-slate-400 text-sm">
                  12 original preset templates scanned automatically from <code className="text-blue-400 bg-slate-900 px-1 py-0.5 rounded">/templates-library/</code>.
                </p>
              </div>
              <div className="text-xs text-slate-400 bg-slate-900 border border-slate-800 px-3 py-2 rounded-lg flex items-center gap-2">
                <ShieldCheck className="w-4 h-4 text-emerald-400" />
                <span>Zero Data Loss — Activating preserves all articles & media!</span>
              </div>
            </div>

            {/* Extensibility Notice */}
            <div className="bg-blue-950/40 border border-blue-800/60 rounded-xl p-4 text-sm text-blue-200 flex items-start gap-3">
              <Sparkles className="w-5 h-5 text-blue-400 shrink-0 mt-0.5" />
              <div>
                <strong className="text-white">Arsitektur Modular &amp; Auto-Detection:</strong> Anda dapat membuat folder baru di <code className="bg-slate-900 px-1.5 py-0.5 rounded text-blue-300">/templates-library/nama-portal/</code> yang berisi <code className="text-amber-300">template.json</code> dan <code className="text-amber-300">config.json</code>. Theme akan langsung mendeteksinya di dashboard WordPress tanpa perlu mengubah file <code className="text-blue-300">functions.php</code>!
              </div>
            </div>

            {/* Grid of Templates */}
            <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
              {THEME_TEMPLATES.map((tpl) => {
                const isActive = tpl.id === activeTemplateId;
                return (
                  <div
                    key={tpl.id}
                    className={`rounded-xl border overflow-hidden flex flex-col transition-all duration-200 ${
                      isActive
                        ? 'border-blue-500 bg-slate-900 shadow-xl shadow-blue-500/10 ring-1 ring-blue-500'
                        : 'border-slate-800 bg-slate-900/60 hover:border-slate-700 hover:bg-slate-900'
                    }`}
                  >
                    {/* Template Preview Graphic */}
                    <div className="relative aspect-[16/10] bg-slate-950 overflow-hidden border-b border-slate-800">
                      {tpl.previewSvg ? (
                        <div
                          className="w-full h-full [&>svg]:w-full [&>svg]:h-full"
                          dangerouslySetInnerHTML={{ __html: tpl.previewSvg }}
                        />
                      ) : (
                        <div className="w-full h-full flex items-center justify-center text-slate-600 font-bold">
                          {tpl.name}
                        </div>
                      )}
                      {isActive && (
                        <span className="absolute top-3 right-3 bg-emerald-500 text-white text-xs font-bold px-2.5 py-1 rounded-full shadow-lg flex items-center gap-1.5">
                          <CheckCircle2 className="w-3.5 h-3.5" /> Active
                        </span>
                      )}
                    </div>

                    {/* Template Info */}
                    <div className="p-5 flex-1 flex flex-col justify-between space-y-4">
                      <div className="space-y-2">
                        <div className="flex items-center justify-between">
                          <h3 className="font-bold text-white text-lg">{tpl.name}</h3>
                          <span className="text-xs bg-slate-800 text-slate-300 px-2 py-0.5 rounded font-mono">
                            v{tpl.version}
                          </span>
                        </div>
                        <span className="text-xs font-semibold text-blue-400 block">{tpl.category}</span>
                        <p className="text-sm text-slate-400 line-clamp-2 leading-relaxed">
                          {tpl.description}
                        </p>

                        {/* Features Tags */}
                        <div className="flex flex-wrap gap-1.5 pt-1">
                          {tpl.supported_features.map((feat, idx) => (
                            <span key={idx} className="text-xs bg-slate-800/80 text-slate-300 px-2 py-0.5 rounded border border-slate-700/50">
                              {feat}
                            </span>
                          ))}
                        </div>
                      </div>

                      {/* Actions */}
                      <div className="pt-4 border-t border-slate-800 flex items-center justify-between">
                        <button
                          onClick={() => setSelectedTemplateForModal(tpl)}
                          className="text-xs text-slate-400 hover:text-white font-medium underline underline-offset-4"
                        >
                          View template.json
                        </button>
                        {isActive ? (
                          <span className="text-xs text-emerald-400 font-semibold flex items-center gap-1">
                            <Check className="w-4 h-4" /> Currently Active
                          </span>
                        ) : (
                          <button
                            onClick={() => handleActivateTemplate(tpl)}
                            className="px-3.5 py-1.5 rounded-lg bg-blue-600 hover:bg-blue-500 text-white text-xs font-semibold transition-all shadow"
                          >
                            Activate Layout
                          </button>
                        )}
                      </div>
                    </div>
                  </div>
                );
              })}
            </div>
          </div>
        )}

        {/* TAB 3: THEME OPTIONS SIMULATOR */}
        {activeTab === 'options' && (
          <div className="space-y-6">
            <div className="flex flex-col md:flex-row md:items-center justify-between gap-4">
              <div>
                <h2 className="text-2xl font-bold text-white">Theme Options Dashboard Simulator</h2>
                <p className="text-slate-400 text-sm">
                  Interactive simulator representing the 36-category WordPress Admin panel (`ADJDEV News -&gt; Theme Options`).
                </p>
              </div>
              <div className="flex items-center gap-3">
                <button
                  onClick={() => {
                    navigator.clipboard.writeText(simulatedConfigJson);
                    setCopiedJson(true);
                    setTimeout(() => setCopiedJson(false), 2000);
                  }}
                  className="px-3 py-1.5 rounded-lg bg-slate-800 hover:bg-slate-700 text-xs font-medium text-slate-200 border border-slate-700 flex items-center gap-1.5"
                >
                  {copiedJson ? <Check className="w-3.5 h-3.5 text-emerald-400" /> : <Copy className="w-3.5 h-3.5" />}
                  {copiedJson ? 'Copied JSON!' : 'Export Config JSON'}
                </button>
              </div>
            </div>

            {/* Simulated Options Container */}
            <div className="grid grid-cols-1 lg:grid-cols-4 rounded-xl border border-slate-800 bg-slate-900 overflow-hidden shadow-xl">
              {/* Simulator Sidebar */}
              <div className="border-r border-slate-800 bg-slate-950 p-4 space-y-1">
                <div className="text-xs font-bold text-slate-400 uppercase tracking-wider px-3 py-2">
                  Option Categories
                </div>
                {[
                  { id: 'general', label: 'General & Layout', icon: Sliders },
                  { id: 'header', label: 'Header & Navigation', icon: Monitor },
                  { id: 'colors', label: 'Global Design Tokens', icon: Sparkles },
                  { id: 'darkmode', label: 'Dark Mode Controls', icon: Moon },
                  { id: 'single', label: 'Single Post Features', icon: FileCode },
                  { id: 'ads', label: 'Advertisement Slots', icon: Layers },
                ].map((item) => {
                  const Icon = item.icon;
                  const isActive = simActiveTab === item.id;
                  return (
                    <button
                      key={item.id}
                      onClick={() => setSimActiveTab(item.id)}
                      className={`w-full flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-colors text-left ${
                        isActive
                          ? 'bg-blue-600/20 text-blue-400 border border-blue-500/30'
                          : 'text-slate-400 hover:bg-slate-900 hover:text-slate-200'
                      }`}
                    >
                      <Icon className="w-4 h-4" />
                      <span>{item.label}</span>
                    </button>
                  );
                })}
              </div>

              {/* Simulator Body */}
              <div className="lg:col-span-3 p-6 sm:p-8 space-y-6">
                {simActiveTab === 'general' && (
                  <div className="space-y-6">
                    <h3 className="text-lg font-bold text-white border-b border-slate-800 pb-3">General Settings</h3>
                    <div className="grid grid-cols-1 sm:grid-cols-2 gap-6">
                      <div className="space-y-2">
                        <label className="text-sm font-semibold text-slate-300">Website Layout Mode</label>
                        <select
                          value={simSiteLayout}
                          onChange={(e) => setSimSiteLayout(e.target.value)}
                          className="w-full bg-slate-950 border border-slate-700 rounded-lg px-3 py-2 text-sm text-slate-200"
                        >
                          <option value="fullwidth">Full Width Container (Default)</option>
                          <option value="boxed">Boxed Frame (1200px)</option>
                        </select>
                      </div>

                      <div className="space-y-2">
                        <label className="text-sm font-semibold text-slate-300">Active Preset</label>
                        <input
                          type="text"
                          readOnly
                          value={activeTemplate.name}
                          className="w-full bg-slate-950 border border-slate-800 rounded-lg px-3 py-2 text-sm text-slate-400"
                        />
                      </div>
                    </div>
                  </div>
                )}

                {simActiveTab === 'header' && (
                  <div className="space-y-6">
                    <h3 className="text-lg font-bold text-white border-b border-slate-800 pb-3">Header &amp; Navigation</h3>
                    <div className="grid grid-cols-1 sm:grid-cols-2 gap-6">
                      <div className="space-y-2">
                        <label className="text-sm font-semibold text-slate-300">Header Layout Style</label>
                        <select
                          value={simHeaderLayout}
                          onChange={(e) => setSimHeaderLayout(e.target.value)}
                          className="w-full bg-slate-950 border border-slate-700 rounded-lg px-3 py-2 text-sm text-slate-200"
                        >
                          <option value="default">Default (Logo Left, Menu Right)</option>
                          <option value="classic">Classic (Logo &amp; Banner Top, Nav Below)</option>
                          <option value="center-logo">Center Logo &amp; Centered Nav</option>
                          <option value="magazine">Magazine Portal with Ad Banner</option>
                          <option value="minimal">Minimal Clean Single-Line</option>
                        </select>
                      </div>

                      <div className="flex items-center justify-between p-4 bg-slate-950 rounded-lg border border-slate-800">
                        <div>
                          <div className="font-semibold text-sm text-white">Breaking News Ticker</div>
                          <div className="text-xs text-slate-400">Show real-time headline marquee</div>
                        </div>
                        <input
                          type="checkbox"
                          checked={simBreakingNews}
                          onChange={(e) => setSimBreakingNews(e.target.checked)}
                          className="w-5 h-5 accent-blue-600 rounded"
                        />
                      </div>
                    </div>
                  </div>
                )}

                {simActiveTab === 'colors' && (
                  <div className="space-y-6">
                    <h3 className="text-lg font-bold text-white border-b border-slate-800 pb-3">Global Design Tokens (CSS Variables)</h3>
                    <div className="grid grid-cols-1 sm:grid-cols-3 gap-6">
                      <div className="space-y-2">
                        <label className="text-sm font-semibold text-slate-300">Primary Accent (--adjdev-primary)</label>
                        <div className="flex items-center gap-3">
                          <input
                            type="color"
                            value={simPrimaryColor}
                            onChange={(e) => setSimPrimaryColor(e.target.value)}
                            className="w-10 h-10 rounded border border-slate-700 bg-transparent cursor-pointer"
                          />
                          <input
                            type="text"
                            value={simPrimaryColor}
                            onChange={(e) => setSimPrimaryColor(e.target.value)}
                            className="w-full bg-slate-950 border border-slate-700 rounded-lg px-3 py-2 text-sm text-slate-200 font-mono"
                          />
                        </div>
                      </div>

                      <div className="space-y-2">
                        <label className="text-sm font-semibold text-slate-300">Secondary Dark (--adjdev-secondary)</label>
                        <div className="flex items-center gap-3">
                          <input
                            type="color"
                            value={simSecondaryColor}
                            onChange={(e) => setSimSecondaryColor(e.target.value)}
                            className="w-10 h-10 rounded border border-slate-700 bg-transparent cursor-pointer"
                          />
                          <input
                            type="text"
                            value={simSecondaryColor}
                            onChange={(e) => setSimSecondaryColor(e.target.value)}
                            className="w-full bg-slate-950 border border-slate-700 rounded-lg px-3 py-2 text-sm text-slate-200 font-mono"
                          />
                        </div>
                      </div>

                      <div className="space-y-2">
                        <label className="text-sm font-semibold text-slate-300">Badge Highlight (--adjdev-accent)</label>
                        <div className="flex items-center gap-3">
                          <input
                            type="color"
                            value={simAccentColor}
                            onChange={(e) => setSimAccentColor(e.target.value)}
                            className="w-10 h-10 rounded border border-slate-700 bg-transparent cursor-pointer"
                          />
                          <input
                            type="text"
                            value={simAccentColor}
                            onChange={(e) => setSimAccentColor(e.target.value)}
                            className="w-full bg-slate-950 border border-slate-700 rounded-lg px-3 py-2 text-sm text-slate-200 font-mono"
                          />
                        </div>
                      </div>
                    </div>
                  </div>
                )}

                {simActiveTab === 'darkmode' && (
                  <div className="space-y-6">
                    <h3 className="text-lg font-bold text-white border-b border-slate-800 pb-3">Dark Mode Controls</h3>
                    <div className="flex items-center justify-between p-4 bg-slate-950 rounded-lg border border-slate-800">
                      <div>
                        <div className="font-semibold text-sm text-white">Enable Front-end Dark Mode Toggle</div>
                        <div className="text-xs text-slate-400">Allows visitors to toggle light/dark modes with local storage memory</div>
                      </div>
                      <input
                        type="checkbox"
                        checked={simDarkMode}
                        onChange={(e) => setSimDarkMode(e.target.checked)}
                        className="w-5 h-5 accent-blue-600 rounded"
                      />
                    </div>
                  </div>
                )}

                {simActiveTab === 'single' && (
                  <div className="space-y-6">
                    <h3 className="text-lg font-bold text-white border-b border-slate-800 pb-3">Single Post Features</h3>
                    <div className="space-y-4">
                      <div className="flex items-center justify-between p-4 bg-slate-950 rounded-lg border border-slate-800">
                        <div>
                          <div className="font-semibold text-sm text-white">Automated Table of Contents (TOC)</div>
                          <div className="text-xs text-slate-400">Automatically parses H2 and H3 headings with smooth scrolling</div>
                        </div>
                        <input
                          type="checkbox"
                          checked={simTOC}
                          onChange={(e) => setSimTOC(e.target.checked)}
                          className="w-5 h-5 accent-blue-600 rounded"
                        />
                      </div>

                      <div className="flex items-center justify-between p-4 bg-slate-950 rounded-lg border border-slate-800">
                        <div>
                          <div className="font-semibold text-sm text-white">Reading Progress Indicator</div>
                          <div className="text-xs text-slate-400">Fixed top progress bar reflecting article scroll percentage</div>
                        </div>
                        <input
                          type="checkbox"
                          checked={simReadingProgress}
                          onChange={(e) => setSimReadingProgress(e.target.checked)}
                          className="w-5 h-5 accent-blue-600 rounded"
                        />
                      </div>
                    </div>
                  </div>
                )}

                {simActiveTab === 'ads' && (
                  <div className="space-y-6">
                    <h3 className="text-lg font-bold text-white border-b border-slate-800 pb-3">Configurable Advertisement Slots</h3>
                    <div className="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm">
                      {['Header Banner (728x90)', 'Before Article Content', 'Middle In-Content (Paragraph 3)', 'After Article Content', 'Sidebar Ad Widget Area', 'Footer Fullwidth Ad'].map((slot, idx) => (
                        <div key={idx} className="p-4 bg-slate-950 border border-slate-800 rounded-lg flex items-center justify-between">
                          <span className="font-medium text-slate-300">{slot}</span>
                          <span className="text-xs px-2 py-0.5 rounded bg-emerald-500/20 text-emerald-400 font-mono">Configured</span>
                        </div>
                      ))}
                    </div>
                  </div>
                )}
              </div>
            </div>
          </div>
        )}

        {/* TAB 4: THEME CODE EXPLORER */}
        {activeTab === 'files' && (
          <div className="space-y-6">
            <div className="flex flex-col md:flex-row md:items-center justify-between gap-4">
              <div>
                <h2 className="text-2xl font-bold text-white">Theme File Explorer &amp; Code Inspector</h2>
                <p className="text-slate-400 text-sm">
                  Inspect the source code of all {THEME_FILES.length} files inside the <code className="text-blue-400 bg-slate-900 px-1 py-0.5 rounded">/adjdev-news/</code> WordPress theme directory.
                </p>
              </div>

              <div className="flex items-center gap-3">
                <a
                  href={THEME_ZIP_URL}
                  download={THEME_ZIP_NAME}
                  className="px-4 py-2 rounded-lg bg-blue-600 hover:bg-blue-500 text-white text-xs font-semibold flex items-center gap-2"
                >
                  <Download className="w-3.5 h-3.5" />
                  Download Theme ZIP
                </a>
              </div>
            </div>

            {/* Split View Explorer */}
            <div className="grid grid-cols-1 lg:grid-cols-12 rounded-xl border border-slate-800 bg-slate-900 overflow-hidden shadow-2xl min-h-[620px]">
              {/* File Tree List */}
              <div className="lg:col-span-4 border-r border-slate-800 bg-slate-950 flex flex-col">
                <div className="p-3 border-b border-slate-800">
                  <div className="relative">
                    <Search className="w-4 h-4 absolute left-3 top-3 text-slate-500" />
                    <input
                      type="text"
                      placeholder="Filter files..."
                      value={fileSearch}
                      onChange={(e) => setFileSearch(e.target.value)}
                      className="w-full bg-slate-900 border border-slate-800 rounded-lg pl-9 pr-3 py-1.5 text-xs text-slate-200 placeholder-slate-500 focus:outline-none focus:border-blue-500"
                    />
                  </div>
                </div>

                <div className="flex-1 overflow-y-auto max-h-[560px] p-2 space-y-0.5 font-mono text-xs">
                  {filteredFiles.map((file) => {
                    const isSelected = selectedFile?.path === file.path;
                    const isPhp = file.path.endsWith('.php');
                    const isCss = file.path.endsWith('.css');
                    const isJson = file.path.endsWith('.json');
                    return (
                      <button
                        key={file.path}
                        onClick={() => setSelectedFile(file)}
                        className={`w-full text-left px-3 py-1.5 rounded flex items-center justify-between transition-colors ${
                          isSelected
                            ? 'bg-blue-600 text-white font-medium'
                            : 'text-slate-400 hover:bg-slate-900 hover:text-slate-200'
                        }`}
                      >
                        <div className="flex items-center gap-2 truncate">
                          <FileCode className={`w-3.5 h-3.5 shrink-0 ${
                            isPhp ? 'text-purple-400' : isCss ? 'text-cyan-400' : isJson ? 'text-amber-400' : 'text-slate-400'
                          }`} />
                          <span className="truncate">{file.path}</span>
                        </div>
                        <span className={`text-[10px] ml-2 shrink-0 ${isSelected ? 'text-blue-200' : 'text-slate-600'}`}>
                          {(file.size / 1024).toFixed(1)}k
                        </span>
                      </button>
                    );
                  })}
                </div>
              </div>

              {/* Code Viewer */}
              <div className="lg:col-span-8 flex flex-col bg-slate-900">
                <div className="px-6 py-3 border-b border-slate-800 flex items-center justify-between bg-slate-950">
                  <div className="flex items-center gap-3">
                    <span className="font-mono text-xs font-semibold text-blue-400 bg-blue-500/10 px-2 py-1 rounded border border-blue-500/20">
                      {selectedFile?.path}
                    </span>
                    <span className="text-xs text-slate-500">
                      {selectedFile ? `${selectedFile.size} bytes` : ''}
                    </span>
                  </div>
                  <button
                    onClick={handleCopyCode}
                    className="flex items-center gap-1.5 text-xs text-slate-300 hover:text-white bg-slate-800 hover:bg-slate-700 px-3 py-1.5 rounded transition"
                  >
                    {copiedCode ? <Check className="w-3.5 h-3.5 text-emerald-400" /> : <Copy className="w-3.5 h-3.5" />}
                    {copiedCode ? 'Copied' : 'Copy Code'}
                  </button>
                </div>

                <div className="flex-1 p-6 overflow-x-auto max-h-[560px] font-mono text-xs text-slate-300 leading-relaxed bg-slate-900 selection:bg-blue-600 selection:text-white">
                  <pre className="whitespace-pre">{selectedFile?.content || '// Select a file to view content'}</pre>
                </div>
              </div>
            </div>
          </div>
        )}

        {/* TAB 5: ADJDEV BUILDER API */}
        {activeTab === 'builder' && (
          <div className="space-y-8">
            <div>
              <h2 className="text-2xl font-bold text-white">ADJDEV Builder Foundation API</h2>
              <p className="text-slate-400 text-sm">
                Theme didesain agar dapat bekerja dengan plugin terpisah &quot;ADJDEV Builder&quot; (visual page builder milik sendiri).
              </p>
            </div>

            <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
              {/* Hooks & Filters */}
              <div className="p-6 rounded-xl bg-slate-900 border border-slate-800 space-y-4">
                <h3 className="font-bold text-white text-lg flex items-center gap-2">
                  <Terminal className="w-5 h-5 text-blue-400" />
                  Action Hooks Available
                </h3>
                <p className="text-sm text-slate-400">
                  Plugin builder dapat menyisipkan section atau header tanpa perlu mengubah file core theme:
                </p>
                <div className="bg-slate-950 p-4 rounded-lg font-mono text-xs text-blue-300 space-y-2 border border-slate-800">
                  <div>do_action( &apos;adjdev_news_loaded&apos; );</div>
                  <div>do_action( &apos;adjdev_news_before_site_wrapper&apos; );</div>
                  <div>do_action( &apos;adjdev_news_after_header&apos; );</div>
                  <div>do_action( &apos;adjdev_news_before_footer&apos; );</div>
                  <div>do_action( &apos;adjdev_news_after_site_wrapper&apos; );</div>
                </div>
              </div>

              {/* Section Registry API */}
              <div className="p-6 rounded-xl bg-slate-900 border border-slate-800 space-y-4">
                <h3 className="font-bold text-white text-lg flex items-center gap-2">
                  <Layers className="w-5 h-5 text-purple-400" />
                  Section Registration API
                </h3>
                <p className="text-sm text-slate-400">
                  Mendaftarkan block visual yang dapat dirender secara modular:
                </p>
                <div className="bg-slate-950 p-4 rounded-lg font-mono text-xs text-emerald-300 border border-slate-800">
                  <pre className="whitespace-pre">
{`ADJDEV_News_Builder_API::register_section(
  'breaking_grid',
  array(
    'title'    => 'Breaking News Grid',
    'category' => 'news',
    'render_callback' => function( $settings ) {
       // Custom render code
    }
  )
);`}
                  </pre>
                </div>
              </div>
            </div>

            {/* Design Tokens & CSS Variables */}
            <div className="p-6 rounded-xl bg-slate-900 border border-slate-800 space-y-4">
              <h3 className="font-bold text-white text-lg">Design Tokens CSS Variables</h3>
              <p className="text-sm text-slate-400">
                Semua style frontend diatur menggunakan CSS variables baku untuk kompatibilitas penuh:
              </p>
              <div className="grid grid-cols-2 sm:grid-cols-4 gap-3 font-mono text-xs">
                {['--adjdev-primary', '--adjdev-secondary', '--adjdev-accent', '--adjdev-text', '--adjdev-background', '--adjdev-border', '--adjdev-container', '--adjdev-radius'].map((varName, idx) => (
                  <div key={idx} className="p-3 bg-slate-950 rounded border border-slate-800 text-slate-300">
                    <span className="text-blue-400">{varName}</span>
                  </div>
                ))}
              </div>
            </div>
          </div>
        )}

        {/* TAB 6: INSTALLATION GUIDE */}
        {activeTab === 'guide' && (
          <div className="space-y-8 max-w-4xl">
            <div>
              <h2 className="text-2xl font-bold text-white">WordPress Installation &amp; Setup Guide</h2>
              <p className="text-slate-400 text-sm">
                Langkah mudah menginstall theme ADJDEV News di website WordPress Anda.
              </p>
            </div>

            <div className="space-y-6">
              <div className="p-6 rounded-xl bg-slate-900 border border-slate-800 flex gap-4">
                <div className="w-8 h-8 rounded-full bg-blue-600 text-white font-bold flex items-center justify-center shrink-0">
                  1
                </div>
                <div className="space-y-2">
                  <h3 className="text-lg font-bold text-white">Download File ZIP Theme</h3>
                  <p className="text-sm text-slate-300">
                    Klik tombol <strong className="text-blue-400">Download Theme (.zip)</strong> di bagian atas halaman ini untuk mengunduh arsip <code className="bg-slate-800 px-1 py-0.5 rounded text-amber-300">adjdev-news.zip</code>.
                  </p>
                </div>
              </div>

              <div className="p-6 rounded-xl bg-slate-900 border border-slate-800 flex gap-4">
                <div className="w-8 h-8 rounded-full bg-blue-600 text-white font-bold flex items-center justify-center shrink-0">
                  2
                </div>
                <div className="space-y-2">
                  <h3 className="text-lg font-bold text-white">Upload ke WordPress Admin</h3>
                  <p className="text-sm text-slate-300">
                    Buka Dashboard WordPress Anda &rarr; <strong>Appearance (Tampilan)</strong> &rarr; <strong>Themes (Tema)</strong> &rarr; <strong>Add New (Tambah Baru)</strong> &rarr; <strong>Upload Theme</strong> &rarr; Pilih file <code className="bg-slate-800 px-1 py-0.5 rounded text-amber-300">adjdev-news.zip</code> &rarr; Klik <strong>Install Now</strong>.
                  </p>
                </div>
              </div>

              <div className="p-6 rounded-xl bg-slate-900 border border-slate-800 flex gap-4">
                <div className="w-8 h-8 rounded-full bg-blue-600 text-white font-bold flex items-center justify-center shrink-0">
                  3
                </div>
                <div className="space-y-2">
                  <h3 className="text-lg font-bold text-white">Aktifkan &amp; Pilih Template</h3>
                  <p className="text-sm text-slate-300">
                    Setelah aktivasi, buka menu baru di sidebar admin: <strong>ADJDEV News &rarr; Template Library</strong>. Anda dapat langsung memilih dan mengaktifkan salah satu dari 12 template layout (seperti News Modern, Tempo Style, Detik Style, Kompas Style, Tech News, dll.) dalam 1 klik!
                  </p>
                </div>
              </div>
            </div>
          </div>
        )}
      </main>

      {/* Modal for viewing template.json */}
      {selectedTemplateForModal && (
        <div className="fixed inset-0 z-50 bg-black/80 backdrop-blur-sm flex items-center justify-center p-4">
          <div className="bg-slate-900 border border-slate-800 rounded-2xl max-w-2xl w-full p-6 space-y-4 shadow-2xl">
            <div className="flex items-center justify-between border-b border-slate-800 pb-3">
              <h3 className="text-lg font-bold text-white">{selectedTemplateForModal.name} &mdash; template.json</h3>
              <button
                onClick={() => setSelectedTemplateForModal(null)}
                className="text-slate-400 hover:text-white text-sm font-semibold"
              >
                Close &times;
              </button>
            </div>
            <div className="bg-slate-950 p-4 rounded-xl font-mono text-xs text-amber-300 overflow-x-auto max-h-96">
              <pre>{JSON.stringify(selectedTemplateForModal, null, 2)}</pre>
            </div>
          </div>
        </div>
      )}

      {/* Footer */}
      <footer className="border-t border-slate-800 bg-slate-950 py-8 text-center text-xs text-slate-500">
        <div className="max-w-7xl mx-auto px-4 flex flex-col sm:flex-row items-center justify-between gap-4">
          <div>
            &copy; {new Date().getFullYear()} <strong>ADJDEV News</strong>. Premium WordPress Theme &amp; Builder Foundation.
          </div>
          <div className="flex items-center gap-4">
            <span>Requires PHP 8.1+</span>
            <span>&bull;</span>
            <span>WordPress 6.2 - 6.7+</span>
            <span>&bull;</span>
            <span>100% Vanilla JS</span>
          </div>
        </div>
      </footer>
    </div>
  );
}
