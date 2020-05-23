const routes = [
  {
    path: "/",
    component: () => import("pages/User.vue")
  },
  // managerUser routes
  {
    path: "/manager_index",
    component: () => import("layouts/managerMainLayout.vue"),
    children: [
      {
        path: "",
        component: () => import("pages/manager_index.vue")
      }
    ]
  },
  {
    path: "/manager/site_ProsCons",
    component: () => import("layouts/managerMainLayout.vue"),
    children: [
      {
        path: "",
        component: () =>
          import("pages/managerUser/prosconsPage/s_prosConsPage.vue")
      }
    ]
  },
  {
    path: "/manager/hotel_ProsCons",
    component: () => import("layouts/managerMainLayout.vue"),
    children: [
      {
        path: "",
        component: () =>
          import("pages/managerUser/prosconsPage/h_prosConsPage.vue")
      }
    ]
  },
  {
    path: "/manager/site_Path",
    component: () => import("layouts/managerMainLayout.vue"),
    children: [
      {
        path: "",
        component: () => import("pages/managerUser/pathPage/s_pathPage.vue")
      }
    ]
  },

  // generalUser routes
  {
    path: "/index",
    component: () => import("layouts/MainLayout.vue"),
    children: [
      {
        path: "",
        component: () => import("pages/index.vue")
      }
    ]
  },
  {
    path: "/arrange-schedule",
    component: () =>
      import("pages/generalUser/arrangeSchedule/arrange-schedule.vue")
    // children: [{ path: "", component: () => import("pages/class.vue") }]
  },
  {
    path: "/PageAuth",
    component: () => import("layouts/MainLayout.vue"),
    children: [
      {
        path: "",
        component: () => import("pages/PageAuth.vue")
      }
    ]
  },
  {
    path: "/mySchedule",
    component: () => import("layouts/MainLayout.vue"),
    children: [
      {
        path: "",
        component: () =>
          import("pages/generalUser/arrangeSchedule/mySchedule.vue")
      }
    ]
  },

  {
    path: "/site_demend",
    component: () => import("layouts/MainLayout.vue"),
    children: [
      {
        path: "",
        component: () => import("pages/generalUser/demendPage/s_demendPage.vue")
      }
    ]
  },
  {
    path: "/hotel_demend",
    component: () => import("layouts/MainLayout.vue"),
    children: [
      {
        path: "",
        component: () => import("pages/generalUser/demendPage/h_demendPage.vue")
      }
    ]
  },
  {
    path: "/site_ProsCons",
    component: () => import("layouts/MainLayout.vue"),
    children: [
      {
        path: "",
        component: () =>
          import("pages/generalUser/prosconsPage/s_prosConsPage.vue")
      }
    ]
  },
  {
    path: "/hotel_ProsCons",
    component: () => import("layouts/MainLayout.vue"),
    children: [
      {
        path: "",
        component: () =>
          import("pages/generalUser/prosconsPage/h_prosConsPage.vue")
      }
    ]
  },
  {
    path: "/site_Path",
    component: () => import("layouts/MainLayout.vue"),
    children: [
      {
        path: "",
        component: () => import("pages/generalUser/pathPage/s_pathPage.vue")
      }
    ]
  },
  {
    path: "/AjaxTest",
    component: () => import("layouts/MainLayout.vue"),
    children: [
      {
        path: "",
        component: () => import("pages/AjaxTest.vue")
      }
    ]
  },
  {
    path: "/CardTest",
    component: () => import("layouts/MainLayout.vue"),
    children: [
      {
        path: "",
        component: () => import("pages/test/cardview.vue")
      }
    ]
  },

  {
    path: "/waypoints",
    component: () => import("layouts/MainLayout.vue"),
    children: [
      {
        path: "",
        component: () => import("pages/WayPoint.vue")
      }
    ]
  },
  {
    path: "/collection",
    component: () => import("layouts/MainLayout.vue"),
    children: [
      {
        path: "",
        component: () => import("pages/generalUser/collection/collection.vue")
      }
    ]
  }
];

// Always leave this as last one
if (process.env.MODE !== "ssr") {
  routes.push({
    path: "*",
    component: () => import("pages/Error404.vue")
  });
}

export default routes;
