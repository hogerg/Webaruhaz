using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using Webaruhaz.Models;
using System.Data.Entity;
using System.Data.Entity.ModelConfiguration.Conventions;

namespace Webaruhaz.DAL
{
    public class TermekContext : DbContext
    {
        public TermekContext() : base("TermekContext")
        {
        }

        public DbSet<Termek> Termekek { get; set; }

        protected override void OnModelCreating(DbModelBuilder modelBuilder)
        {
            modelBuilder.Conventions.Remove<PluralizingTableNameConvention>();
        }
    }
}