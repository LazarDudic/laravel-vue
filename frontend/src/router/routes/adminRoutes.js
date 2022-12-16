import isAdminMiddleware from '@/middleware/isAdminMiddleware'

const routes = [
  {
    path: '/admin/dashboard',
    name: 'admin-dashboard',
    components: { admin: import('@/views/admin/pages/Dashboard.vue') },
    meta: { middleware: isAdminMiddleware }
  },
  {
    path: '/admin/pages',
    name: 'admin-pages-list',
    components: { admin: import('@/views/admin/pages/PageList.vue') },
    meta: { middleware: isAdminMiddleware }
  },
  {
    path: '/admin/pages/create',
    name: 'admin-pages-create',
    components: { admin: import('@/views/admin/pages/PageCreate.vue') },
    meta: { middleware: isAdminMiddleware }
  },
  {
    path: '/admin/pages/edit/:id',
    name: 'admin-pages-edit',
    components: { admin: import('@/views/admin/pages/PageEdit.vue') },
    meta: { middleware: isAdminMiddleware }
  },
  {
    path: '/admin/pages/create-or-edit/:groupId/:langId/',
    name: 'admin-pages-create-or-edit',
    components: {admin: import('@/views/admin/pages/PageCreateOrEdit.vue')},
    meta: { middleware: isAdminMiddleware }
  },
  {
    path: '/admin/users',
    name: 'admin-users-list',
    components: { admin: import('@/views/admin/users/UserList.vue') },
    meta: { middleware: isAdminMiddleware }
  },
  {
    path: '/admin/users/create',
    name: 'admin-users-create',
    components: { admin: import('@/views/admin/users/UserCreate.vue') },
    meta: { middleware: isAdminMiddleware }
  },
  {
    path: '/admin/users/edit/:id',
    name: 'admin-users-edit',
    components: { admin: import('@/views/admin/users/UserEdit.vue') },
    meta: { middleware: isAdminMiddleware }
  },
  {
    path: '/admin/app-settings',
    name: 'admin-app-settings',
    components: { admin: import('@/views/admin/settings/AppSettings.vue') },
    meta: { middleware: isAdminMiddleware }
  },
  {
    path: '/admin/global-settings',
    name: 'admin-global-settings-list',
    components: { admin: import('@/views/admin/settings/GlobalSettingsList.vue')},
    meta: { middleware: isAdminMiddleware }
  },
  {
    path: '/admin/global-settings/edit/:id',
    name: 'admin-global-settings-edit',
    components: {
      admin: import('@/views/admin/settings/GlobalSettingsEdit.vue')
    },
    meta: { middleware: isAdminMiddleware }
  },
  {
    path: '/admin/languages',
    name: 'admin-languages-list',
    components: { admin: import('@/views/admin/languages/LanguageList.vue') },
    meta: { middleware: isAdminMiddleware }
  },
  {
    path: '/admin/languages/create',
    name: 'admin-languages-create',
    components: { admin: import('@/views/admin/languages/LanguageCreate.vue') },
    meta: { middleware: isAdminMiddleware }
  },
  {
    path: '/admin/languages/edit/:id',
    name: 'admin-languages-edit',
    components: { admin: import('@/views/admin/languages/LanguageEdit.vue') },
    meta: { middleware: isAdminMiddleware }
  },
  {
    path: '/admin/categories',
    name: 'admin-categories-list',
    components: { admin: import('@/views/admin/categories/CategoryList.vue') },
    meta: { middleware: isAdminMiddleware }
  },
  {
    path: '/admin/categories/create',
    name: 'admin-categories-create',
    components: {admin: import('@/views/admin/categories/CategoryCreate.vue')},
    meta: { middleware: isAdminMiddleware }
  },
  {
    path: '/admin/categories/edit/:id',
    name: 'admin-categories-edit',
    components: { admin: import('@/views/admin/categories/CategoryEdit.vue') },
    meta: { middleware: isAdminMiddleware }
  },
  {
    path: '/admin/categories/create-or-edit/:groupId/:langId/:type',
    name: 'admin-categories-create-or-edit',
    components: {admin: import('@/views/admin/categories/CategoryCreateOrEdit.vue')},
    meta: { middleware: isAdminMiddleware }
  },
  {
    path: '/admin/news',
    name: 'admin-news-list',
    components: { admin: import('@/views/admin/news/NewsList.vue') },
    meta: { middleware: isAdminMiddleware }
  },
  {
    path: '/admin/news/create',
    name: 'admin-news-create',
    components: { admin: import('@/views/admin/news/NewsCreate.vue') },
    meta: { middleware: isAdminMiddleware }
  },
  {
    path: '/admin/news/edit/:id',
    name: 'admin-news-edit',
    components: { admin: import('@/views/admin/news/NewsEdit.vue') },
    meta: { middleware: isAdminMiddleware }
  },
  {
    path: '/admin/news/create-or-edit/:groupId/:langId/',
    name: 'admin-news-create-or-edit',
    components: {admin: import('@/views/admin/news/NewsCreateOrEdit.vue')},
    meta: { middleware: isAdminMiddleware }
  },
]

export default routes
