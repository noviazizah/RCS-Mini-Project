﻿// <auto-generated />
using CargoTrackingApp_v4.Data;
using Microsoft.EntityFrameworkCore;
using Microsoft.EntityFrameworkCore.Infrastructure;
using Microsoft.EntityFrameworkCore.Metadata;
using Microsoft.EntityFrameworkCore.Storage.ValueConversion;

#nullable disable

namespace CargoTrackingApp_v4.Migrations
{
    [DbContext(typeof(ApplicationDbContext))]
    partial class ApplicationDbContextModelSnapshot : ModelSnapshot
    {
        protected override void BuildModel(ModelBuilder modelBuilder)
        {
#pragma warning disable 612, 618
            modelBuilder
                .HasAnnotation("ProductVersion", "8.0.6")
                .HasAnnotation("Relational:MaxIdentifierLength", 64);

            MySqlModelBuilderExtensions.AutoIncrementColumns(modelBuilder);

            modelBuilder.Entity("CargoTrackingApp.Models.Stamformation", b =>
                {
                    b.Property<int>("StamformationId")
                        .ValueGeneratedOnAdd()
                        .HasColumnType("int");

                    MySqlPropertyBuilderExtensions.UseMySqlIdentityColumn(b.Property<int>("StamformationId"));

                    b.Property<string>("CarriageCode")
                        .IsRequired()
                        .HasMaxLength(20)
                        .HasColumnType("varchar(20)");

                    b.Property<string>("CarriageOrder")
                        .IsRequired()
                        .HasColumnType("longtext");

                    b.Property<string>("TrainNumber")
                        .IsRequired()
                        .HasMaxLength(20)
                        .HasColumnType("varchar(20)");

                    b.HasKey("StamformationId");

                    b.HasIndex("TrainNumber");

                    b.ToTable("Stamformations");
                });

            modelBuilder.Entity("CargoTrackingApp.Models.Station", b =>
                {
                    b.Property<string>("StationCode")
                        .HasMaxLength(10)
                        .HasColumnType("varchar(10)");

                    b.Property<double>("Latitude")
                        .HasColumnType("double");

                    b.Property<double>("Longitude")
                        .HasColumnType("double");

                    b.Property<string>("StationName")
                        .IsRequired()
                        .HasMaxLength(100)
                        .HasColumnType("varchar(100)");

                    b.HasKey("StationCode");

                    b.ToTable("Stations");
                });

            modelBuilder.Entity("CargoTrackingApp.Models.Train", b =>
                {
                    b.Property<string>("TrainNumber")
                        .HasMaxLength(20)
                        .HasColumnType("varchar(20)");

                    b.Property<string>("Route")
                        .IsRequired()
                        .HasColumnType("longtext");

                    b.Property<string>("TrainName")
                        .IsRequired()
                        .HasMaxLength(100)
                        .HasColumnType("varchar(100)");

                    b.HasKey("TrainNumber");

                    b.ToTable("Trains");
                });

            modelBuilder.Entity("CargoTrackingApp.Models.Stamformation", b =>
                {
                    b.HasOne("CargoTrackingApp.Models.Train", "Train")
                        .WithMany()
                        .HasForeignKey("TrainNumber")
                        .OnDelete(DeleteBehavior.Cascade)
                        .IsRequired();

                    b.Navigation("Train");
                });
#pragma warning restore 612, 618
        }
    }
}
