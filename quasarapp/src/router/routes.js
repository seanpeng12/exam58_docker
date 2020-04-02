const routes = [{
  path: '/',
  component: () => import('layouts/Layout.vue'),
  children: [{
      path: '',
      component: () => import('pages/PageTodo.vue')
    },
    {
      path: '/settings',
      component: () => import('pages/PageSettings.vue')
    },
    {
      path: '/sql',
      component: () => import('pages/testSQL.vue')
    },
    {
      path: '/cardV',
      component: () => import('pages/testCard.vue')
    }
  ]
}]

// Always leave this as last one
if (process.env.MODE !== 'ssr') {
  routes.push({
    path: '*',
    component: () => import('pages/Error404.vue')
  })
}

export default routes
