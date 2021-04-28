module.exports = [
    {
        path: '/',
        component: () => import('@/pages/home/Home')
    },
    {
        path: '/profile',
        component: () => import('@/pages/profile/Profile')
    },
];