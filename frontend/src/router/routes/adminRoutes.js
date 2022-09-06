import isAdminMiddleware from '@/middleware/isAdminMiddleware'

const routes = [
  {
    path: '/admin/dashboard',
    name: 'admin-dashboard',
    component: () => import('@/views/admin/pages/Dashboard.vue'),
    meta: { middleware: isAdminMiddleware }
  },
  {
    path: '/admin/users',
    name: 'admin-users-list',
    component: () => import('@/views/admin/users/UserList.vue'),
    meta: { middleware: isAdminMiddleware }
  },
  {
    path: '/admin/users/create',
    name: 'admin-users-create',
    component: () => import('@/views/admin/users/UserCreate.vue'),
    meta: { middleware: isAdminMiddleware }
  },
  {
    path: '/admin/users/edit/:id',
    name: 'admin-users-edit',
    component: () => import('@/views/admin/users/UserEdit.vue'),
    meta: { middleware: isAdminMiddleware }
  },
  {
    path: '/admin/roles',
    name: 'admin-roles-list',
    component: () => import('@/views/admin/roles/RoleList.vue'),
    meta: { middleware: isAdminMiddleware }
  },
  {
    path: '/admin/roles/create',
    name: 'admin-roles-create',
    component: () => import('@/views/admin/roles/RoleCreate.vue'),
    meta: { middleware: isAdminMiddleware }
  },
  {
    path: '/admin/roles/edit/:id',
    name: 'admin-roles-edit',
    component: () => import('@/views/admin/roles/RoleEdit.vue'),
    meta: { middleware: isAdminMiddleware }
  },
  {
    path: '/admin/settings',
    name: 'admin-settings',
    component: () => import('@/views/admin/pages/GlobalSettings.vue'),
    meta: { middleware: isAdminMiddleware }
  },
  {
    path: '/admin/permissions',
    name: 'admin-permissions-list',
    component: () => import('@/views/admin/permissions/PermissionList.vue'),
    meta: { middleware: isAdminMiddleware }
  },
  {
    path: '/admin/permissions/create',
    name: 'admin-permissions-create',
    component: () => import('@/views/admin/permissions/PermissionCreate.vue'),
    meta: { middleware: isAdminMiddleware }
  },
  {
    path: '/admin/permissions/edit/:id',
    name: 'admin-permissions-edit',
    component: () => import('@/views/admin/permissions/PermissionEdit.vue'),
    meta: { middleware: isAdminMiddleware }
  },
]

export default routes
