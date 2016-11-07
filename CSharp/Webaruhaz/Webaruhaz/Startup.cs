using Microsoft.Owin;
using Owin;

[assembly: OwinStartupAttribute(typeof(Webaruhaz.Startup))]
namespace Webaruhaz
{
    public partial class Startup
    {
        public void Configuration(IAppBuilder app)
        {
            ConfigureAuth(app);
        }
    }
}
