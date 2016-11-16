using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Data.Entity;

namespace Webshop.Models
{
    public class SampleData : DropCreateDatabaseIfModelChanges<StoreEntities>
    {
        protected override void Seed(StoreEntities context)
        {
            var categories = new List<Category>
            {
                new Category { Name = "Display" },
                new Category { Name = "HDD" },
                new Category { Name = "VGA" }
            };

            categories.ForEach(c => context.Categories.Add(c));

            context.SaveChanges();

            new List<Product>
            {
                new Product { Name = "Szupermonitor", Category = categories.Single(c => c.Name == "Display"), Price = 60000},
                new Product { Name = "SzuperHDD", Category = categories.Single(c => c.Name == "HDD"), Price = 25000},
                new Product { Name = "SzuperVGA", Category = categories.Single(c => c.Name == "VGA"), Price = 120000},
                new Product { Name = "Szupermonitor 2", Category = categories.Single(c => c.Name == "Display"), Price = 80000}
            }.ForEach(p => context.Products.Add(p));

            context.SaveChanges();
        }
    }
}